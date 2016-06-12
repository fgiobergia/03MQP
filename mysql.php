<?php

$hostname = 'localhost';
$username = 'root';
$password = '9zpiqsc3';
$database = 'distrib';


$conn = new mysqli ($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die ('Connection error: ' + $conn->connect_error);
}

