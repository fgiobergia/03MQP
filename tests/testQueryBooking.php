<?php
include 'mysql.php';

$start = array(10,15,5,13,5);
$dur = array(10,10,10,5,20);
$expected = array(true,false,false,true,false);

for ($i = 0; $i < count($start); $i++) {
    $startTime = $start[$i];
    $endTime = $startTime + $dur[$i];
    $query = "
    SELECT MId
    FROM MACHINES
    WHERE MId NOT IN (
        SELECT MId
        FROM BOOKINGS
        WHERE StartTime < {$endTime}
        AND StartTime + Duration > {$startTime})
    LIMIT 1";
    $res = $conn->query($query);
    if (is_bool($res)) {
        echo "ERROR " . $i . ": " . $conn->error . "\n";
        continue;
    }
    $outcome = ($res->fetch_row() != null);
    if ($outcome === $expected[$i]) {
        echo "Ok\n";
    }
    else {
        echo "Failed " . $i . "\n";
    }
}
?>
