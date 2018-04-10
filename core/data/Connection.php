<?php 
namespace Core\Data; 

class Connection {
    private $connection; 

    public function __construct() {
        $parameters = fopen("./app/config/parameters.json", "r") or die("Check permissions or see if file exists.");
        $parametersJSON = fread($parameters,filesize("./app/config/parameters.json"));
        $parametersObject = json_decode($parametersJSON);
        try {
        $this->connection = new \PDO($parametersObject->dbms.":host=".$parametersObject->host.";".$parametersObject->db, $parametersObject->user, $parametersObject->password, [
            \PDO::ATTR_PERSISTENT => $parametersObject->PDOPersistance
        ]);
        }
        catch(PDOExecption $error){
            var_dump($error);
            die("PDOException Error");
        }

    }
    
    public function getConnection(){
        return $this->connection;
    }

    public function disconnect() {
        $this->connect = null;
    }
}



?>