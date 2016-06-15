<?php

function _hash ($user, $pass) {
    return hash ('sha512',$user.$pass);
}

$v = array('u1@p.it'=>'p','u2@p.it'=>'p2','u3@p.it'=>'p3');

foreach ($v as $key => $val) {
    echo $key.' '._hash($key,$val)."\n";
}
