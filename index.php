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
    <script src = 'js/handlers.js'></script>
    <script src = 'js/login_form.js'></script>
    <script src = 'js/reservations.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $websiteName; ?>
    </div>
<?php
if (isset($_GET['success'])) {
?>
    <div class = 'success'>
        Operation carried out successfully!
    </div>
<?php
}
?>
    <div id = 'main_content'>
        <form action = 'login.php' method = 'POST' id = 'login_form'>
            <div class = 'form_row'>
                <label class = 'form_cell'>Email address</label>
                <input class = 'form_cell' type = 'text' id = 'email' name = 'email' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password</label>
                <input class = 'form_cell password' type = 'password' id = 'pass' name = 'pass' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'button' id = 'send' value = 'Login'/>
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
