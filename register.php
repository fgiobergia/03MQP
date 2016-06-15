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
    <script src = 'js/register_form.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $linkToHome; ?>
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
                <input title = 'Your first name' class = 'form_cell' type = 'text' name = 'first' id = 'first' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Last name</label>
                <input title = 'Your last name' class = 'form_cell' type = 'text' name = 'last' id = 'last' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Email address</label>
                <input title = 'A valid email address. This will be your username' class = 'form_cell' type = 'text' id = 'email' name = 'email' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password</label>
                <input title = 'A secret password that will be required upon login' class = 'form_cell password' type = 'password' id = 'pass1' name = 'pass1' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Password (again)</label>
                <input title = 'The same password as before. Just making sure you typed it right' class = 'form_cell password' type = 'password'  id = 'pass2' name = 'pass2' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'submit' id = 'send' value = 'Register'/>
            </div>
        </form>
    </div>
  </body>
</html>
