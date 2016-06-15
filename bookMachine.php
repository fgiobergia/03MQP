<?php

include 'includes.php';

$session = new Session();
if (!$session->isValid()) {
    redirect();
}

$uid = $session->getUId();
$start = sanitize($_POST['start_time']); // no sanitizing need, but still...
$duration = intval ($_POST['duration']); // intval() renders sanitize() useless
$token = sanitize($_POST['csrf']);

if (preg_match("/^(\d{2}):(\d{2})$/", $start, $match) !== 1) {
    // 0 or FALSE returned
    redirect("book.php?error");
}
$hh = intval($match[1]);
$mm = intval($match[2]);

if ($hh < 0 || $hh > 23 || $mm < 0 || $mm > 59 || $duration < 1 || $duration > 1440) {
    redirect("book.php?error");
}

if (!validToken($session->getUId(), $token)) {
    redirect("book.php?error");
}

$startTime = $hh * 60 + $mm;
$endTime = $startTime + $duration;

// now all data should be valid
$query = "
INSERT INTO RESERVATIONS (UId, MId, StartTime, Duration, Timestamp)
SELECT {$uid}, MId, {$startTime}, {$duration}, ".time()."
FROM MACHINES
WHERE MId NOT IN (
    SELECT MId
    FROM RESERVATIONS
    WHERE StartTime < $endTime
    AND StartTime + Duration > $startTime)
LIMIT 1";
$conn->query($query);
if ($conn->affected_rows == 1) {
    // success!
    redirect ("book.php?success");
}
else {
    redirect ("book.php?overlap");
}
?>
