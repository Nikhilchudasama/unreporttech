<script>
    $(document).ready(function () {
		$("#add-form-button").on("click", function(){
			setupModelDetails('Add @yield("title")', $('#add-form-contents').html());
			updateFormInput();
		});
	});

	$(document).ready(function() {
		$("#add-form-btn").on("click", function() {
			var url = $(this).data('url');
			axios.get(url)
				.then(function(response) {
					setupModelDetails('Add @yield("title")', response.data);
					updateFormInput();
				})
				.catch(function(error) {
					console.log(error);
				});
		});
	});

	$(document).on('click', '.edit-form-button', function(){
		var url = $(this).data('url');

		axios.get(url)
		.then(function (response) {
			setupModelDetails('Edit @yield("title")', response.data);
			updateFormInput();
		})
		.catch(function (error) {
			console.log(error);
		});
	});

	$(document).on('click', '.view-form-button', function(){
		var url = $(this).data('url');

		axios.get(url)
		.then(function (response) {
			setupModelDetails('View @yield("title")', response.data);
			updateFormInput();
		})
		.catch(function (error) {
			console.log(error);
		});
	});

	$(document).on('click', '.permant-delete-button', function(){
		var url = $(this).data('url');

		axios.get(url)
		.then(function (response) {
			showNotice('success', 'Delete Permant');
			setTimeout(function(){
				window.location.reload();
			}, 1000);
		})
		.catch(function (error) {
			console.log(error);
		});
    });

    $(document).on('click', '.delete-button', function(){
        // showLoader();
        var url = $(this).data('url');
        $.ajax({
            type: "DELETE",
            // method: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            data: {_method: 'delete', _token :"{{ csrf_token() }}"},
            processData: false,
            contentType: false,
        }).done(function(response) {
            hideLoader();
            reloadTable()
        }).fail(function (jqXhr) {
            hideLoader();
        });
    });

	$(document).on('submit', '#add-form', function (event) {
			event.preventDefault();
            showLoader();
			axios.post(
				$(this).attr('action'),
				new FormData(this)
			)
			.then(function (response) {
                hideLoader();

				if(response.data.status){
					showNotice('success', '@yield("title") Added Successfully');
					$('#common-popup').modal('hide');
					reloadTable()
				}else{
					errorMessage(response.data.message);
				}
			})
			.catch(function (error) {
                hideLoader();
				var errors = error.response.data.errors;
				showValidationError(errors);
			});
	});

	$(document).on('submit', '#edit-form', function (event) {
		event.preventDefault();
        showLoader();
		axios.post(
			$(this).attr('action'),
			new FormData(this)
		)
		.then(function (response) {
            hideLoader();
			if(response.data.status){
				showNotice('success', '@yield("title") Updated Successfully');
				$('#common-popup').modal('hide');
				if(response.data.data.reload)
					location.reload();
				else
					reloadTable()
			}else{
				errorMessage(response.data.message);
			}
		})
		.catch(function (error) {
            hideLoader();
			var errors = error.response.data.errors;
			showValidationError(errors);
		});
	});

	function setupModelDetails(popupTitle, popupContent) {
        $('#popup-title').html(popupTitle);
        $('#popup-content').html(popupContent);
        $('#error-messages').addClass('d-none');
        $('#common-popup').modal();
	}

    function showValidationError(errors) {
        var errorMessages = '<ul>';

        for (var key in errors) {
            if (errors.hasOwnProperty(key)) {
                errorMessages += '<li>' + errors[key] + '</li>';
            }
        }
        errorMessages += '</ul>';

        $('#error-messages').html(errorMessages);
        $('#error-messages').removeClass('d-none');
        $('#error-messages').scrollTop();
        $('#common-popup').animate({ scrollTop: 0 }, 'slow');
    }
	function errorMessage(message){
		var errorMessages = '<ul>';
		errorMessages += '<li>' + message + '</li>';
		errorMessages += '</ul>';
		$('#error-messages').html(errorMessages);
        $('#error-messages').removeClass('d-none');
        $('#error-messages').scrollTop();
        $('#common-popup').animate({ scrollTop: 0 }, 'slow');
	}

	function reloadTable(){
		var table = $('#users-table').DataTable();
		table.ajax.reload();
	}
</script>
