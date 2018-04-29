<?php 
namespace Core\Data;

class RepositoryLoader {
    public function loadRepository($requested){
        $path = "./app/config/repositories.json";
        $registered = fopen($path) or die("repositories.json not found or there are insufficent file permissions");
        $data = fread($registered, filesize($path))
    }
}

?>