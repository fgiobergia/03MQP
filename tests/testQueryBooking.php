<?php
include '../mysql.php';

$start = array(10,15,5,13,5,25,22,30,35,37,30,37,42,35);
$dur = array(10,10,10,5,20,7,6,3,5,2,7,5,3,6);
$expected = array(1,false,false,1,false,false,false,1,true,true,1,false,false,2);

for ($i = 0; $i < count($dur); $i++) {
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
    $outcome = $res->fetch_row();
    if (($outcome == null && $expected[$i] == false) || ($outcome != null && $outcome[0] == $expected[$i]) || ($outcome != null && $expected[$i] === true)) {
        echo "Ok\n";
    }
    else {
        echo "Failed " . $i . "\n";
    }
}
?>
