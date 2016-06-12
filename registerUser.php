<?php

include 'includes.php';

$session = new Session();
if ($session->isValid()) {
    // user already logged in!
    redirect ();
}

$firstName = sanitize ($_POST['first']);
$lastName  = sanitize ($_POST['last']);
$emailAddr = sanitize ($_POST['email']);
$password1 = hash_password ($emailAddr, $_POST['pass1']);
$password2 = hash_password ($emailAddr, $_POST['pass2']);
/* various conditions are handled differently in 
 * order to ease a possible future decision of 
 * providing a more detailed error message for
 * each case
 * For the time being, the following list of if's
 * could be reduced to () || () || ()
 */
if (filter_var ($emailAddr, FILTER_VALIDATE_EMAIL) === false) {
    // email address not valid!
    redirect ("register.php?error");
}

// if pass1 is not empty, then pass2 must not be empty for the 
// second condition to be false, thus that test has been omitted
if (empty($_POST['pass1']) || $password1 != $password2) {
    // no password entered, or mismatching ones
    redirect ("register.php?error");
}

if (empty ($firstName) || empty ($lastName)) {
    redirect ("register.php?error");
}

// everything seems to be fine, carry on with the registration
$query = "INSERT INTO USERS (FirstName, LastName, Email, Password)".
         "VALUES ('{$firstName}','{$lastName}','{$emailAddr}','{$password1}');";
if ($conn->query($query) === false) {
    // failure!
    redirect ("register.php?error"); // not really meaningful for the user!
                                      // But, a more detailed error system could
                                      // be introduced (see comment above)
}
else {
    redirect ("?success");
}
?>


