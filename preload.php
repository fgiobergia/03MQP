<?php

// actions to be carried out before displaying the page

// enforce HTTPS
if ($enforceHttps === true) {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
        header ("Location: https://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
        die();
    }
}

// test whether the number of machines available is in accordance with $machinesNo
/* this scripts keeps the information in the database consistent
 * according to the following set of rules:
 * 1) the lowest MId for a machine is 1
 * 2) the highest MId for a machine is $machinesNo
 * 3) All machines have unique MIds between 1 and $machinesNo
 * Manually changing the database may alter this set of assumptions,
 * thus messing with this part of code. 
 */
$query = "SELECT COUNT(*) FROM MACHINES";
$res = $conn->query($query);
if ($res !== false) {
    $row = $res->fetch_row();
    if ($row !== null) {
        $num = intval($row[0]);
        if ($num > $machinesNo) {
            // There're more machines than desired! Cut some down!
            // [!!!] this script will automatically pick the machines
            // to be deleted, regardless of whether reservations for those
            // machines have been made (if reservations exist, the behavior
            // of this script is undefined (depends on the policy enforced by the dbms)
            $query = "DELETE FROM MACHINES WHERE MId > {$machinesNo}";
            $conn->query($query);
        }
        else if ($num < $machinesNo) {
            $query = "INSERT INTO MACHINES (MId, Name) VALUES ";
            for ($i = $num + 1; $i <= $machinesNo; $i++) {
                $query .= "({$i},'Machine {$i}')" . (($i == $machinesNo) ? "" : ",");
            }
            $conn->query($query);
        }
    }
}
?>
