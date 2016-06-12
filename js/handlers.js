var redColor   = '#ff9999';
var greenColor = '#19ff19';
var borderInfo = '2px solid ';

function testEmail (email) {
    /* coarse regex: may only match a subset of 
        * valid emails - for a stricter one, use google
        */
    var reg = /^[a-zA-Z0-9\.]+@[a-zA-Z0-9\.]+\.[a-zA-Z]{2,4}$/;
    return reg.test(email);
}

function email_handler() {
    var email = $('#email').val();
    if (email.length > 0) {
        if (testEmail(email)) {
            $('#email').css('border', borderInfo + greenColor);
        }
        else {
            $('#email').css('border', borderInfo + redColor);
        }
    }
    else {
        $('#email').css('border','');
    }
}
