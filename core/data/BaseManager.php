<?php 
namespace Core\Data;

//require('core/data/Connection.php');
use Core\Data\Connection;

class BaseManager {   
    protected $options;

    protected $connection; 

    /**
     * @param object $repository
     */
    public function __construct($options){
        $this->options = $options;
        $this->connection = New Connection;
    }
    /**
     * @param int $id
     * @return BaseManager
     */
    public function find(int $id){
        
    }
    /**
     * @return BaseManager
     */
    public function findAll(){
    
    }
    /**
     * @param string $column 
     * @param string $value
     * @return BaseManager
     */
    public function findBy($column, $value){

    }

    /**
     * @param string $query
     * @return BaseManager
     */
    public function executeQuery($query){

    }
}

?>