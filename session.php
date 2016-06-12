<?php

$expirationTime = 2*60; // sessions expire in 2 minutes

class Session {
    private $valid;

    public function __construct ($forceNew = false) {
        global $expirationTime;
        $this->valid = false;
        session_start();

        /*
         * renew session if either $forceNew == true (should only be true when user logs in successfully) or
         * 'valid' = true and the session is yet to expire ('expires' < time())
         */
        if ($forceNew == true || (isset ($_SESSION['valid']) && $_SESSION['valid'] == true && isset($_SESSION['expires']) && $_SESSION['expires'] >= time())) {
            $_SESSION['valid'] = true;
            $_SESSION['expires'] = time() + $expirationTime; // renew session expiration time
            $this->valid = true;
        }
        else {
            // session expired, or no session to begin with
            session_unset();
            session_destroy();
        }
    }

    public function isValid () {
        return $this->valid;
    }
}

?>
