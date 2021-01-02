<?php

/**
* Login Class
* Created by Warner Infinity
* Author Jules Warner
*/

class Login
{
	private $WIdb = null;

	    function __construct() {
       $this->db = Db::getInstance();
       //$this->maint = new WIMaintenace();
    }


        /**
     * Log in user with provided id.
     */
    public function byId($id) {
        if ( $id != 0 && $id != '' && $id != null ) {
            $this->_updateLoginDate($id);
            Session::set("user_id", $id);
            if(LOGIN_FINGERPRINT == true)
                Session::set("login_fingerprint", $this->_generateLoginString ());
        }
    }


        /**
     * Check if user is logged in.
     */
    public function isLoggedIn() {
        //if $_SESSION['user_id'] is not set return false
        if(Session::get("user_id") == null)
             return false;
        
        //if enabled, check fingerprint
        if(LOGIN_FINGERPRINT == true) {
            $loginString  = $this->_generateLoginString();
            $currentString = Session::get("login_fingerprint");
            if($currentString != null && $currentString == $loginString)
                return true;
            else  {
                //destroy session, it is probably stolen by someone
                $this->logout();
                return false;
            }
        }
        
        //if you got to this point, user is logged in
        return true;        
    }


    public function userLogin($username, $password) {
        //validation
        $errors = $this->_validateLoginFields($username, $password);
        if(count($errors) != 0) {
            $result = implode("<br />", $errors);
            echo json_encode(array(
                'status' => 'error',
                'message' => $result
            ));
        }
        
        //protect from brute force attack
/*        if($this->_isBruteForce()) {
            echo json_encode(array(
                'status' => 'error',
                'message' => "Sorry, you have tried too many times"
            ));
            return;
        }*/
        
        //hash password and get data from WIdb
        $password = $this->_hashPassword($password);
        //var_dump($username);
        //echo "past".$password;
        
        $result = $this->db->select(
                    "SELECT * FROM `users`
                     WHERE `username` = :u AND `password` = :p",
                     array(
                       "u" => $username,
                       "p" => $password
                     )
                  );
        //print_r($result);
        
        if(count($result) == 1) 
        {
            if( MAIL_CONFIRMATION_REQUIRED === "true"){
                 if($result[0]['confirmed'] == "N") {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => "Pls check your email."
                ));
                return false;
            }
               
            }

            // check if user is banned
/*            if($result[0]['banned'] == "Y") {
                // increase attempts to prevent touching the DB every time
               // $this->increaseLoginAttempts();

                // return message that user is banned
                echo json_encode(array(
                    'status' => 'error',
                    'message' => "Sorry you have been banned."
                ));
                return false;
            }*/

            //user exist, log him in if he is confirmed
            $this->_updateLoginDate($result[0]['id']);
            Session::set("user_id", $result[0]['id']);
            session_regenerate_id(true);
            if(LOGIN_FINGERPRINT == true)
                Session::set("login_fingerprint", $this->_generateLoginString ());
            
            return true;

           

        }
        else {
            //wrong username/password combination
            $this->increaseLoginAttempts();
             echo json_encode(array(
                'status' => 'error',
                'message' => "Sorry wrong username/password combination."
             ));
            return false;
        }
    }


        /**
     * Increase login attempts from specific IP address to preven brute force attack.
     */
    public function increaseLoginAttempts() {
        $date    = date("Y-m-d");
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $table   = 'wi_login_attempts';
       
        //get current number of attempts from this ip address
        $loginAttempts = $this->_getLoginAttempts();
        
        //if they are greater than 0, update the value
        //if not, insert new row
        if($loginAttempts > 0)
            $this->db->update (
                        $table, 
                        array( "attempt_number" => $loginAttempts + 1 ), 
                        "`ip_addr` = :ip_addr AND `date` = :d", 
                        array( "ip_addr" => $user_ip, "d" => $date)
                      );
        else
            $this->db->insert($table, array(
                "ip_addr" => $user_ip,
                "date"    => $date
            ));
    }


    /**
     * Log out user and destroy session.
     */
    public function logout() {
        Session::destroySession();
    }

      /**
     * Check if someone is trying to break password with brute force attack.
     * @return TRUE if number of attemts are greater than allowed, FALSE otherwise.
     */
    public function _isBruteForce()
    {
        return $this->_getLoginAttempts() > LOGIN_MAX_LOGIN_ATTEMPTS;
    }


        /* PRIVATE AREA
     =================================================*/

         private function _validateLoginFields($username, $password) {
        $id     = $_POST['id'];
        $errors = array();
        
        if($username == "")
            $errors[] = "Username required";
        
        if($password == "")
            $errors[] = "Password required.";
        
        return $errors;
    }
    

        private function _generateLoginString() {
        $userIP = $_SERVER['REMOTE_ADDR'];
        $userBrowser = $_SERVER['HTTP_USER_AGENT'];
        $loginString = hash('sha512',$userIP.$userBrowser);
        return $loginString;
    }

        private function _getLoginAttempts() {
        $date = date("Y-m-d");
        $user_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;

        if ( ! $user_ip )
            return PHP_INT_MAX;
        
         $query = "SELECT `attempt_number`
                   FROM `wi_login_attempts`
                   WHERE `ip_addr` = :ip AND `date` = :date";

        $result = $this->db->select($query, array(
            "ip"    => $user_ip,
            "date"  => $date
        ));

        if(count($result) == 0)
            return 0;

        return intval($result[0]['attempt_number']);
    }

    private function _hashPassword($password) {
        $register = new Register();
        $NewPAss = $register->hashPassword($password);
        //echo $NewPAss;
        return $NewPAss;
    }
    
    
    /**
     * Update database with login date and time when this user is logged in.
     * @param int $userid Id of user that is logged in.
     */
    private function _updateLoginDate($userid) {
        $this->db->update(
                    "users",
                    array("last_login" => date("Y-m-d H:i:s")),
                    "id = :u",
                    array( "u" => $userid)
                );
    }


}
