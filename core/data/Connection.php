<?php 
namespace Core\Data; 

class Connection {
    private $connection; 

    public function __construct() {
        $parameters = fopen("../../app/config/parameters.json", "r") or die("Unable to open file, check permissions or existance");
        $parametersJSON = fread($parameters,filesize("../../app/config/parameters.json"));
        $parametersObject = json_decode($parametersJSON);
        
    }
}



?>