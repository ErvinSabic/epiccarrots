<?php 
namespace Core\Data; 

class Connection {
    public function __construct() {
        $parameters = fopen("./app/config/parameters.json", "r") or die("Check permissions or see if file exists.");
        $parametersJSON = fread($parameters,filesize("./app/config/parameters.json"));
        $parametersObject = json_decode($parametersJSON);
        try {
        $this->connection = 
            new \PDO(
                $parametersObject->dbms.":host=".
                $parametersObject->host.";"."dbname=".
                $parametersObject->db.";", 
                $parametersObject->user, 
                $parametersObject->password, [
                    \PDO::ATTR_PERSISTENT => $parametersObject->PDOPersistance
                ]
        );
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOExecption $error){
            echo "<pre>";
            print_r($error);
            echo "</pre>";
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