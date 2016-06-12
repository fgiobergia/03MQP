<?php
include 'includes.php';

$session = new Session();
if ($session->isValid()) {
    // nothing to do here, go to index.html
    redirect ("account.php");
}

?>

<!doctype html>
<html>
  <head>
    <title><?php echo $websiteName; ?></title>
    <link rel = 'stylesheet' type = 'text/css' href = 'css/style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src = 'js/handlers.js'></script>
    <script src = 'js/register_form.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $websiteName; ?>
    </div>
<?php
if (isset($_GET['error'])) {
?>
    <div class = 'error'>
        Uhm. Something may be wrong with your data!
    </div>
<?php
}
?>
    <div id = 'main_content'>
        <form action = 'registerUser.php' method = 'POST' id = 'register_form'>
            <div class = 'form_row'>
                <label class = 'form_cell'>First name</label>
                <input class = 'form_cell' type = 'text' name = 'first' id = 'first' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Last name</label>
                <input class = 'form_cell' type = 'text' name = 'last' id = 'last' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Email address</label>
                <input class = 'form_cell' type = 'text' id = 'email' name = 'email' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password</label>
                <input class = 'form_cell password' type = 'password' id = 'pass1' name = 'pass1' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password (again)</label>
                <input class = 'form_cell password' type = 'password'  id = 'pass2' name = 'pass2' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'button' id = 'send' value = 'Register'/>
            </div>
        </form>
    </div>
    <div id = 'footer' class = 'banner'>
<?php
include 'footer.html';
?>
    </div>
  </body>
</html>
