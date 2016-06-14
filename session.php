<?php


class Session {
    private $valid;

    public function __construct ($forceNew = false, $uid = -1) {
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

            // if login time, also store the UId for later retrieval
            if ($uid != -1) {
                $_SESSION['uid'] = $uid;
            }
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

    public function getUId () {
        if ($this->isValid()) {
            return intval($_SESSION['uid']);
        }
        return -1;
    }

}

?>
