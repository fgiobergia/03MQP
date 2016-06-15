<?php
include 'includes.php';

$session = new Session(false,-1,isset($_GET['welcome']));

if (!$session->hasCookies()) {
    die ("This website requires <b>cookies</b>. ");
}

if (!$session->isValid()) {
    // not logged in, or session has expired!
    redirect ();
}

if (!$session->hasCookies()) {
    die ("This website requires <b>cookies</b>. ");
}

$uid = $session->getUId();

$token = md5(rand().rand().rand()); // hash the number to make it fancier (also, standard length)
$query = "DELETE FROM TOKENS WHERE Expiration < " . time();
$conn->query($query);
$query = "INSERT INTO TOKENS (UId, Token, Expiration) VALUES ({$uid},'{$token}',".(time()+$expirationTime).")";
$conn->query($query);
// valid session, yay!
?>
<!doctype html>
<html>
  <head>
    <title><?php echo $websiteName; ?></title>
    <link rel = 'stylesheet' type = 'text/css' href = 'css/style.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src = 'js/convert.js'></script>
    <script src = 'js/handlers.js'></script>
    <script src = 'js/book_form.js'></script>
    <script src = 'js/reservations.js'></script>
  </head>
  <body>
    <div id = 'header' class = 'banner'>
<?php echo $linkToHome; ?>
    </div>
<?php
$msg = '';
if (isset($_GET['error'])) {
    $msg = 'Some error occurred!';
    $div = 'error';
}
else if (isset($_GET['overlap'])) {
    $msg = 'Your reservation would not fit the current schedule. Please try with a different time slot!';
    $div = 'error';
}
else if (isset($_GET['success'])) {
    $msg = 'Action performed successfully';
    $div = 'success';
}
else if (isset($_GET['welcome'])) {
    $msg = "Welcome back, {$session->getFirstName()}";
    $div = 'success';
}
if (!empty ($msg)) {
?>
    <div class = 'message <?php echo $div; ?>'><?php echo $msg; ?></div>
<?php
}
?>
    <noscript>
        <div class = 'message notice'>This website uses JavaScript. Disabling it may affect your experience.</div>
    </noscript>
    <div id = 'main_content'>
        <form action = 'bookMachine.php' method = 'POST' id = 'book_form'>
            <input type = 'hidden' name = 'csrf' value = '<?php echo $token; ?>'>
            <div class = 'form_row'>
                <label class = 'form_cell'>Starting time</label>
                <input title = 'Start time. May be a value between 00:00 and 23:59' class = 'form_cell' type = 'time' id = 'start_time' name = 'start_time' placeholder = '00:00' />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'>Duration</label>
                <input title = 'Duration, in minutes (between 1 and 1440)' class = 'form_cell' type = 'number' min = '1' max = '1440' id = 'duration' name = 'duration'  />
            </div>
            <div class = 'form_row'>
                <label class = 'form_cell'></label>
                <input class = 'form_cell' type = 'submit' id = 'send' value = 'Book'/>
            </div>
        </form>
        <div class = 'table_title'>
            Your reservations
        </div>
        <div class = 'reservations'>
            <div class = 'list_row head_row'>
                <span class = 'list_cell'>Machine</span>
                <span class = 'list_cell'>Start Time</span>
                <span class = 'list_cell'>End Time</span>
                <span class = 'list_cell'>Duration</span>
                <span class = 'list_cell'>Cancel</span>
            </div>
<?php

$query = "SELECT M.MId, Name, StartTime, Duration FROM RESERVATIONS R, MACHINES M WHERE R.MId = M.MId AND UId = '{$uid}' ORDER BY StartTime";
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
                <span class = 'list_cell unbook'><a href = '<?php echo "cancel.php?mid={$mid}&start={$start}&csrf={$token}"; ?>'>x</a></span>
            </div>
<?php
    }
}
?>
        </div>
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
