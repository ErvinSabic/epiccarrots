<?php 
namespace Core\Data;

//require('core/data/Connection.php');
use Core\Data\Connection;

class BaseManager {   
    protected $repository; 

    protected $connection; 

    /**
     * @param object $repository
     */
    public function __construct($repo){
        $this->repository = $repo;
        $this->connection = New Connection;
    }
    /**
     * @param int $id
     * @return BaseManager
     */
    public function find(int $id){
        $query = $this->connection->prepare("SELECT * FROM ".$this->repository."WHERE id = :id");
        $query->bindParam(':id', $id);
        return $query->execute();

    }
    /**
     * @return BaseManager
     */
    public function findAll(){
        $query = $this->connection->prepare("SELECT * FROM ".$this->repository);
        return $query->execute();
    }
    /**
     * @param string $column 
     * @param string $value
     * @return BaseManager
     */
    public function findBy(string $column, $value){
        $query = $this->connection->prepare("SELECT * FROM ".$this->repository." WHERE :column = :value"); 
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