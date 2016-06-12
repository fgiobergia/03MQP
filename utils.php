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
