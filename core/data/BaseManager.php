<?php 
namespace Core\Data;

use Core\Data\Connection;

class BaseManager {   
    protected $table;

    protected $connection; 

    /**
     * @param object $repository
     */
    public function __construct($data){
        $this->table = $data->table;
        $this->pdo = New Connection;
        $this->connection = $this->pdo->getConnection();
    }
    /**
     * @param int $id
     * @return BaseManager
     */
    public function find(int $id){
        $query = $this->connection->prepare("SELECT * FROM ".$this->table."WHERE id = :id");
        $query->bindParam(':id', $id);
        return $query->execute();

    }
    /**
     * @return BaseManager
     */
    public function findAll(){
        $query = $this->connection->prepare("SELECT * FROM ".$this->table." ;");
        $query->execute();
        $ret = $query->fetchAll();
        $this->pdo->disconnect();
        return $ret;
    }
    /**
     * @param string $column 
     * @param string $value
     * @return BaseManager
     */
    public function findBy(string $column, $value){
        $query = $this->connection->prepare("SELECT * FROM ".$this->table." WHERE :column = :value"); 
        $query->bindParam(':column', $column);
        $query->bindParam(':value', $value);
        return $query->execute();
    }

    /**
     * @param string $query
     * @return BaseManager
     */
    public function executeQuery(string $q){
        $query = $this->connection->prepare($q); 
        return $query->execute();
    }
}

?>