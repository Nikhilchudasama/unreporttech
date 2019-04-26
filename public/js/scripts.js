window.addEventListener('load', function () {
    alertify.set('notifier','position', 'top-right');
});

function showNotice(type, message) {
    var alertifyFunctions = {
        'success': alertify.success,
        'error': alertify.error,
        'info': alertify.message,
        'warning': alertify.warning
    };

    alertifyFunctions[type](message, 10);
}

updateFormInput();

function updateFormInput() {
    $('.form-control').on('blur', function() {
        if ($(this).val().length > 0) {
            $(this).addClass("fill");
        } else {
            $(this).removeClass("fill");
        }
    });

    $('.form-control').on('focus', function() {
        $(this).addClass("fill");
    });

    $(".form-control").each(function(index, element) {
        if (element.value) {
            element.classList.add('fill');
        }
    });
}