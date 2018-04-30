<?php 
namespace Core\Security;

class SessionManager {

    /**
     * Check if session exists
     */
    public function checkIfLoggedIn(){
        if (isset($_SESSION['Username'])){
            return True;
        }
        else 
        {
            return False;
        }
    }

    /**
     * Destroy users login session
     */
    public function destroySession(){
        if(isset($_SESSION['Username'])){
            session_name('epiccarrots'); 
            session_start();
            session_unset("Username");
            session_destroy();
            return true;
        }
        else {
            return false;
        }
    }
}


?>