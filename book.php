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
                <label class = 'form_cell'>Duration (min)</label>
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
<?php
$token = md5(rand().rand().rand()); // hash the number to make it fancier (also, standard length)
$query = "DELETE FROM TOKENS WHERE Expiration < " . time();
$conn->query($query);
$query = "INSERT INTO TOKENS (UId, Token, Expiration) VALUES ({$uid},'{$token}',".(time()+$expirationTime).")";
$conn->query($query);

$query = "SELECT M.MId, Name, StartTime, Duration FROM BOOKINGS B, MACHINES M WHERE B.MId = M.MId AND UId = '{$uid}'";
$res = $conn->query($query);
if ($res !== false) {
    while ($row = $res->fetch_row()) {
        list ($mid, $name, $start, $duration) = $row;
        $start = intval($start);
        $duration = intval($duration);
        $startTime = minutesToString($start);
        $endTime = minutesToString($start + $duration);
        $durationStr = minutesToString ($duration,'h,m');
?>
            <div class = 'list_row'>
                <span class = 'list_cell'><?php echo $name; ?></span>
                <span class = 'list_cell'><?php echo $startTime; ?></span>
                <span class = 'list_cell'><?php echo $endTime; ?></span>
                <span class = 'list_cell'><?php echo $durationStr; ?></span>
                <span class = 'list_cell unbook'><a href = '<?php echo "delete.php?mid={$mid}&start={$start}&csrf={$token}"; ?>'>x</a></span>
            </div>
<?php
    }
}
?>
        </div>
    </div>
    <div id = 'footer' class = 'banner'>
<?php
include 'footer.html';
?>
    </div>
  </body>
</html>
