<?php 
namespace Core\Http;

use Core\Routing\RouteDeserializer;
use Core\Routing\Route;

class Request {

    public $route;

    public $options;

    /**
     * @param string $action
     */
    public function __construct($action){
        $this->route=$action;
    }

    /**
     * Get current action
     */
    public function getRoute(){
        return $this->route;
    }

    /**
     * Gets data from POST request
     */
    public function getData(){
        foreach($_POST as $key => $value){
            if(strpos($key, 'post_data_')>0){
                $this->data[$key]=$value;
            }
        }
        return $data;
    }

    /**
     * @param array $options
     */
    public function setOptions($options){
        $this->options = $options;
    }

    /**
     * Fulfill Request Based On Options Set
     */
    public function serveRequest(){
        $rds = new RouteDeserializer;
        $response = $rds->ProcessRequest($this->options);
        return $response;
    }
}

?>