<?php

function sanitize ($string) {
    global $conn;
    return $conn->escape_string($string);
}

function hash_password ($salt, $password) {
    global $algo;
    return hash ($algo, $salt . $password);
}

function redirect ($path = '') {
    header ("Location: " . __BASE__ . $path);
    die();
}

function minutesToString ($offset, $mode = 'hh:mm') {
    $hh = intval($offset / 60);
    $mm = $offset % 60;
    switch ($mode) {
        case 'h,m':
            $hhFormat = ($hh > 0) ? "%dh, " : "";
            $format = "{$hhFormat}{$mm}m";
            break;
        default:
            $format = "%02d:%02d"; 
            $hh = ($hh > 23) ? $hh - 24 : $hh;
            break;
    }
    return sprintf ($format, $hh, $mm);
}

function validToken ($uid, $token) {
    global $conn;
    if (preg_match("/^[a-f\d]{32}$/", $token) === false) {
        return false;
    }
    $uid = intval($uid); // should be a number stored in a session, but converting to int just in case
    $query = "SELECT UId FROM TOKENS WHERE UId = {$uid} AND Token = '{$token}' AND Expiration >= ".time();
    $res = $conn->query($query);
    if ($res === false) {
        return false;
    }
    $row = $res->fetch_row();
    return $row != null;
}
