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

function emailHandler() {
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

function validTime (time) {
    var reg = /^([0-9]{2}):([0-9]{2})$/;
    var m = time.match(reg);
    if (m == null) {
        return false;
    }
    var hh = parseInt(m[1]);
    var mm = parseInt(m[2]);

    return (hh >= 0 && hh <= 23 && mm >= 0 && mm<=59);
}

function timeHandler () {
    var time = $('#start_time').val();
    if (time.length > 0) {
        if (!validTime(time)) {
            $('#start_time').val('');
        }
    }
}
