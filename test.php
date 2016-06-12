<?

include 'sessions.php';

$session = new Session();

if ($session->isValid()) {
    echo "Nope";
}
else {
    echo "Yup :D";
}

