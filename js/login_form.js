$(document).ready(function() {
    $('#email').keyup(emailHandler);
    $('#email').change(emailHandler);

    $('#send').click(function() {
        var email = $('#email').val();
        var pass = $('#pass').val();
        if (pass.length > 0 && email.length > 0 && testEmail(email)) {
            $('#login_form').submit();
        }
    });
});
