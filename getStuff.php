<?php

include 'includes.php';


header ("Content-Type: application/json");

$insertList = array();
$deleteList = array();

$from = 0;
if (isset ($_GET['t']) && !empty($_GET['t'])) {
    $from = intval($_GET['t']);

    $query = "SELECT MId, Timestamp, StartTime FROM CANCELLATIONS WHERE Timestamp > {$from}";
    $res = $conn->query($query);
    if ($res !== false) {
        while (($row = $res->fetch_row()) !== null) {
            $obj = array();
            list($obj['mid'],$obj['timestamp']) = $row;
            $obj['start'] = minutesToString($row[2]);
            array_push($deleteList,$obj);
        }
    }
}

$query = "SELECT M.MId, Name, Timestamp, StartTime, Duration FROM RESERVATIONS R, MACHINES M WHERE M.MId = R.MId AND Timestamp > {$from}";
$res = $conn->query($query);
if ($res !== false) {
    while (($row = $res->fetch_row()) !== null) {
        $obj = array();
        list($obj['mid'],$obj['machineName'],$obj['timestamp']) = $row;
        $obj['start'] = minutesToString($row[3]);
        $obj['duration'] = minutesToString($row[4],'h,m');
        $obj['end'] = minutesToString(intval($row[3])+intval($row[4]));
        array_push($insertList, $obj);
    }
}

$json = array();
$json['insertList'] = $insertList;
$json['deleteList'] = $deleteList;
$json['timestamp'] = time();

echo json_encode($json,(isset($_GET['pretty']))? JSON_PRETTY_PRINT : 0);
?>
