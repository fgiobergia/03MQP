<?

include 'includes.php';

$login = sanitize ($_POST['email']);
$password = hash_password($login, $_POST['pass']);

$query = "SELECT UId FROM USERS WHERE Email = '{$login}' AND Password = '{$password}'";
$res = $conn->query($query);
if ($res !== false) {
    // no failure!
    $row = $res->fetch_row();
    if ($row == null) {
        // login failed!
        die ("Nope");
    }
    die ("YEAAAH");
}

?>
