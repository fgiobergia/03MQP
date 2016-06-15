<?php

include 'includes.php';

$session = new Session();
if (!$session->isValid()) {
    redirect();
}

$mid = intval($_GET['mid']);
$start = intval($_GET['start']);
$token = sanitize($_GET['csrf']);

if (validToken($session->getUId(), $token)) {
    // no csrf attempt, carry on!
    $query = "DELETE FROM RESERVATIONS WHERE UId = {$session->getUId()} AND MId = {$mid} AND StartTime = {$start} AND Timestamp + 60 < " . time(); // timestamp < 60: 1 minute rule!
    $res = $conn->query($query);
    if ($res !== false && $conn->affected_rows == 1) {
        $query = "INSERT INTO CANCELLATIONS (MId, StartTime, Timestamp) VALUES ({$mid}, {$start},".time().")";
        $conn->query($query);
        redirect("book.php?success");
    }
}
redirect("book.php?error");
?>
