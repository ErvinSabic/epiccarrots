<?php 
namespace Core\Data;

use Core\Data\BaseManager; 

class RepositoryLoader {
    public function loadRepository($requested){
        $path = "./app/config/repositories.json";
        $registered = fopen($path, 'r') or die("repositories.json not found or there are insufficent file permissions");
        $data = fread($registered, filesize($path)); 
        $repositories = json_decode($data)->Repositories;

        if(!isset($repositories->$requested)){
            die ("Repository not found. Did you forget to register it?");
        }
        $repository = $repositories->$requested;

        if(!file_exists($repository->file)){
            die("File associated with the repository could not be found. Check your repositories file.");
        }else{
            include_once($repository->file);
        }

        if(!class_exists($repository->manager)){
            die("The file assocated with the repository exists, but the class does not. Did you make a mistake in your repositories file?");
        }else {
            $ret = new $repository->manager($repository);
        }

        return $ret;
    }
}

?>