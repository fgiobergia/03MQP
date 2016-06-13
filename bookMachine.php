<?php

include 'includes.php';

$session = new Session();
if (!$session->isValid()) {
    redirect();
}

$uid = $session->getUId();
$start = sanitize($_POST['start_time']); // no sanitizing need, but still...
$duration = intval ($_POST['duration']); // intval() renders sanitize() useless

if (preg_match("/^(\d{2}):(\d{2})$/", $start, $match) !== 1) {
    // 0 or FALSE returned
    redirect("book.php?error");
}
$hh = intval($match[1]);
$mm = intval($match[2]);

if ($hh < 0 || $h > 23 || $mm < 0 || $mm > 59 || $duration < 1 || $duration > 1440) {
    redirect("book.php?error");
}

$startTime = $hh * 60 + $mm;
$endTime = $startTime + $duration;

// now all data should be valid
$query = "
INSERT INTO BOOKINGS (UId, MId, StartTime, Duration)
SELECT {$uid}, MId, {$startTime}, {$endTime}
FROM MACHINES
WHERE MId NOT IN (
    SELECT MId
    FROM BOOKINGS
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
