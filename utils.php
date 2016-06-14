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
            break;
    }
    return sprintf ($format, $hh, $mm);
}

