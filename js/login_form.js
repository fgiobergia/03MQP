$(document).ready(function() {
    $('#email').keyup(email_handler);
    $('#email').change(email_handler);

    $('#send').click(function() {
        var email = $('#email').val();
        var pass = $('#pass').val();
        if (pass.length > 0 && email.length > 0 && testEmail(email)) {
            $('#login_form').submit();
        }
    });
});
