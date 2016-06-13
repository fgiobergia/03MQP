<?php
include 'includes.php';
/*
$session = new Session();
if (!$session->isValid()) {
    // not logged in, or session has expired!
    redirect ();
}
$uid = $session->getUId();
*/
$uid = 1;

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
    $div = 'error';
}
else if (isset($_GET['overlap'])) {
    $msg = 'Your booking would not fit the current schedule. Please try with a different time slot!';
    $div = 'error';
}
else if (isset($_GET['success'])) {
    $msg = 'Time slot booked successfully!';
    $div = 'success';
}
if (!empty ($msg)) {
?>
    <div class = '<?php echo $div; ?>'><?php echo $msg; ?></div>
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
        <div id = 'previous_bookings'>
            <div class = 'list_row' id = 'head_row'>
                <span class = 'list_cell'>Machine</span>
                <span class = 'list_cell'>Start Time</span>
                <span class = 'list_cell'>End Time</span>
                <span class = 'list_cell'>Duration</span>
                <span class = 'list_cell'>Unbook</span>
            </div>
            <div class = 'list_row'>
                <span class = 'list_cell'>Machine 1</span>
                <span class = 'list_cell'>03:30</span>
                <span class = 'list_cell'>03:40</span>
                <span class = 'list_cell'>20m</span>
                <span class = 'list_cell unbook'>x</span>
            </div>
            <div class = 'list_row'>
                <span class = 'list_cell'>Machine 1</span>
                <span class = 'list_cell'>03:30</span>
                <span class = 'list_cell'>03:40</span>
                <span class = 'list_cell'>20m</span>
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
