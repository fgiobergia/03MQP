<?php

// actions to be carried out before displaying the page

// enforce HTTPS
if ($enforceHttps === true) {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
        header ("Location: https://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
        die();
    }
}

?>
