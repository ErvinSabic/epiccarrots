<?php 
namespace Core\Data;

//require('core/data/Connection.php');
use Core\Data\Connection;

class BaseEntity {   
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
     */
    public function find(int $id){
        
    }
    /**
     * @param 
     */
    public function findAll(){

    }
    public function findRelationships(){

    }
    public function executeQuery($query){

    }
}

?>