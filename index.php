<?php
include 'includes.php';

$session = new Session();
if ($session->isValid()) {
    // nothing to do here, go to index.html
    redirect ("book.php");
}

?>

<!doctype html>
<html>
  <head>
    <title><?php echo $websiteName; ?></title>
    <link rel = 'stylesheet' type = 'text/css' href = 'css/style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src = 'js/convert.js'></script>
    <script src = 'js/handlers.js'></script>
    <script src = 'js/login_form.js'></script>
    <script src = 'js/reservations.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $linkToHome; ?>
    </div>
<?php
$msg = '';
if (isset($_GET['success'])) {
    $msg = 'Operation carried out successfully!';
    $div = 'success';
}
else if (isset($_GET['fail'])) {
    $msg = 'Wrong username/password combination';
    $div = 'error';
}
if (!empty($msg)) {
?>
    <div class = 'message <?php echo $div; ?>'>
        <?php echo $msg; ?>
    </div>
<?php
}
?>
    <noscript>
        <div class = 'message notice'>This website uses JavaScript. Disabling it may affect your experience.</div>
    </noscript>
    <div id = 'main_content'>
        <form action = 'login.php' method = 'POST' id = 'login_form'>
            <div class = 'form_row'>
                <label class = 'form_cell'>Email address</label>
                <input title = 'The email address of an already existing account' class = 'form_cell' type = 'text' id = 'email' name = 'email' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password</label>
                <input title = 'The password paired with your email address for this account' class = 'form_cell password' type = 'password' id = 'pass' name = 'pass' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'submit' id = 'send' value = 'Login'/>
                <span id = 'register_link'>(or <a href = 'register.php'>register</a>)</span>
            </div>
        </form>
        <div class = 'table_title'>
            List of reservations
        </div>
        <div class = 'reservations'> 
            <div class = 'list_row head_row'>
                <span class = 'list_cell'>Machine</span>
                <span class = 'list_cell'>Start Time</span>
                <span class = 'list_cell'>End Time</span>
                <span class = 'list_cell'>Duration</span>
            </div>
        </div>

    </div>
    <div id = 'footer' class = 'banner'>
<?php
include 'footer.html';
?>
    </div>
  </body>
</html>
