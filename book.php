<?php
include 'includes.php';

$session = new Session();
if (!$session->isValid()) {
    // not logged in, or session has expired!
    redirect ();
}

// valid session, yay!
?>
<!doctype html>
<html>
  <head>
    <title><?php echo $websiteName; ?></title>
    <link rel = 'stylesheet' type = 'text/css' href = 'css/style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src = 'js/handlers.js'></script>
    <script src = 'js/book_form.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $websiteName; ?>
    </div>
<?php
$msg = '';
if (isset($_GET['error'])) {
    $msg = 'Some error occurred!';
}
else if (isset($_GET['overlap'])) {
    $msg = 'Your booking may not be scheduled with the current resources';
}
if (!empty ($msg)) {
?>
    <div class = 'error'><?php echo $msg; ?></div>
<?php
}
?>
    <div id = 'main_content'>
        <form action = 'bookMachine.php' method = 'POST' id = 'book_form'>
            <div class = 'form_row'>
                <label class = 'form_cell'>Starting time</label>
                <input class = 'form_cell' type = 'time' id = 'start_time' name = 'start_time' placeholder = '00:00' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Duration</label>
                <input class = 'form_cell' type = 'number' min = '0' max = '1440' id = 'duration' name = 'duration'  />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'button' id = 'send' value = 'Book'/>
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
