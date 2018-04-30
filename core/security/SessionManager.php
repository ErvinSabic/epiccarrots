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
            session_destroy();
            return true;
        }
        else {
            return false;
        }
    }
    /**
     * Gets the username of the currently logged in user
     */
    public function getUsername(){
        if(isset($_SESSION['Username'])){
            return $_SESSION['Username'];
        }
        else {
            return false;
        }
    }

    /**
     * Gets the ID of the currently logged in user
     */
    public function getUserId($userManager){
        if(isset($_SESSION['Username'])){
            $username = $_SESSION['Username'];
        }
        else {
            return false;
        }
        $data = $userManager->findBy("username",$username);
        return $data[0]['id'];
    }
}


?>