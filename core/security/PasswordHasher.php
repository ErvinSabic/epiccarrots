<?php 
namespace Core\Security;

class PasswordHasher {
    /**
     * @param string $string
     */
    public function HashString($string){
        $response = password_hash($string, PASSWORD_BCRYPT);
        return $response;
    }

    /**
     * @param string $hash
     * @param string $attempt
     */
    public function HashCheck($hash, $attempt){
        return password_verify($attempt, $hash);
    }

}

?>