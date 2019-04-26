<div class="modal fade" id="changePassword" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="passwordChange" class="form-material" method="post" accept-charset="UTF-8"  action="{{ route('user.udpate-password') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="passwordupdate-notification-container"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-default">
                                <input type="password" name="old_password" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Old Password</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-default">
                                <input type="password" name="password" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>
                        </div>
						<div class="col-sm-12">
                            <div class="form-group form-default">
                                <input type="password" name="password_confirmation" class="form-control">
                                <span class="form-bar"></span>
                                <label class="float-label">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).on('submit', 'form#passwordChange',function(event) {
        // showLoader();
        event.preventDefault();

        var form = this;
        var data = new FormData(this);
        $.ajax({
            method: "POST",
            url: "{{ route('user.udpate-password')}}",
            data: data,
            processData: false,
            contentType: false,
        }).done(function(response) {
            hideLoader();
            if(response.success){
                $('#passwordupdate-notification-container').html(
                `<div class="alert alert-success">
                    <strong>Success!</strong> Password updated
                </div>`
                );
                $(form)[0].reset();
                setTimeout(function() {
                    $('#changePassword').hide();
                },2000);
                location.reload();
            }else{
                $('#passwordupdate-notification-container').html(
                `<div class="alert alert-danger">
                    <strong>Error!</strong>  `+response.message+`
                </div>`
                );
            }

        }).fail(function (jqXhr) {
            hideLoader();
            var data = jqXhr.responseJSON;
            var errorsHtml = '<div class="alert alert-danger"><ul>';

            $.each(data.errors, function (key, value) {
                errorsHtml += '<li>' + value + '</li>';
            });

            errorsHtml += '</ul></div>';

            $('#passwordupdate-notification-container').html(errorsHtml);
        });
    });
</script>
@endpush