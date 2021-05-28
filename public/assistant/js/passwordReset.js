function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function forgetPassword(event) {
    event.preventDefault();
    $('#forgetPasswordForm span.invalid-feedback').remove();
    $('#forgetPasswordForm input.is-invalid').removeClass('is-invalid');
    $('#forgetPasswordForm select.is-invalid').removeClass('is-invalid');
    document.getElementById("forgetButton").disabled = true;

    email = $('#email').val();

    if (email == undefined || email == "") {
        $("#forgetPasswordForm #email").addClass('is-invalid').after('<span class="invalid-feedback" role="alert">\
                <strong>Email is required.</strong></span>');
        document.getElementById("forgetButton").disabled = false;
        return false;

    } else if (!isValidEmail(email)) {
        $("#forgetPasswordForm #email").addClass('is-invalid').after('<span class="invalid-feedback" role="alert">\
                <strong>Email is invalid.</strong></span>');
        document.getElementById("forgetButton").disabled = false;
        return false;
    }

    $.ajax({
        method: "POST",
        url: routes.assistantPasswordForgotEmail,
        data: new FormData($('#forgetPasswordForm')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 0) {
                $("input#forgetButton").after(
                    '<div id="forgot_password_success" class="w-100"> <p class="text-success">' +
                    response.message + '</p> </div>');
                $("#forgetPasswordForm").trigger("reset");
                document.getElementById("forgetButton").disabled = false;
            } else {
                $("#forgot").html('<div id="forgot_password_error" class="w-100"> <p class="text-danger">' +
                    response.error + '</p> </div>');
                document.getElementById("forgetButton").disabled = false;
            }
        }
    });
}
