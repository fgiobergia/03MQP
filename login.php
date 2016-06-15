<?php

include 'includes.php';

$session = new Session();
if ($session->isValid()) {
    redirect("book.php");
}


$login = sanitize ($_POST['email']);
$password = hash_password($login, $_POST['pass']);

$query = "SELECT UId FROM USERS WHERE Email = '{$login}' AND Password = '{$password}'";
$res = $conn->query($query);
if ($res !== false) {
    // no failure!
    $row = $res->fetch_row();
    if ($row == null) {
        // login failed!
        die ("index.php?fail");
    }
    $session = new Session(true,$row[0]);
    redirect("book.php");
}
header ("index.php");

?>
