<?php

class Session {
    private $valid, $hasCookies, $firstName;

    public function __construct ($forceNew = false, $uid = -1, $testCookies = false) {
        global $expirationTime;
        $this->valid = false;
        $this->hasCookies = true;
        session_start();

        /* only testing when the user is supposed to have cookies! */
        if ($testCookies == true) {
            $this->hasCookies = isset($_COOKIE[session_name()]);
        }

        /*
         * renew session if either $forceNew == true (should only be true when user logs in successfully) or
         * 'valid' = true and the session is yet to expire ('expires' < time())
         */
        if ($forceNew == true || (isset ($_SESSION['valid']) && $_SESSION['valid'] == true && isset($_SESSION['expires']) && $_SESSION['expires'] >= time())) {
            $_SESSION['valid'] = true;
            $_SESSION['expires'] = time() + $expirationTime; // renew session expiration time

            // if it's login time, also store the UId for later retrieval
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

    public function hasCookies() {
        return $this->hasCookies;
    }

    public function getFirstName() {
        global $conn;
        if (empty($this->firstName)) {
            $query = "SELECT FirstName FROM USERS WHERE UId = ".$this->getUId();
            $res = $conn->query($query);
            if ($res !== false) {
                $row = $res->fetch_row();
                if ($row !== null) {
                    $this->firstName = htmlentities($row[0]);
                }
            }
        }
        return $this->firstName;
    }

}

?>
