$(document).ready(function() {
    var redColor   = '#ff9999';
    var greenColor = '#19ff19';
    var borderInfo = '2px solid ';

    $('#email').keyup(emailHandler);
    $('#email').change(emailHandler);
    

    $('.password').keyup(passwordHandler);

    $('#send').click(function () {
        var first = $('#first').val();
        var last  = $('#last').val();
        var email = $('#email').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        if (first.length > 0 && last.length > 0 && testEmail(email) && pass1.length > 0 && pass1 === pass2) {
            $('#register_form').submit();
        }
    });
});
