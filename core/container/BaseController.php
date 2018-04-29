<?php 

namespace Core\Container; 

use Core\Templating\RenderEngine;
use Core\Data\Connection;

class BaseController{
    protected $connection;


    public function __construct(){
        $this->connection = new Connection;
    }
    /**
    * Render a file and replace all parmas with curly brackets 
    */
    public function render($template, $data){
        $engine = new RenderEngine();
        $engine->render($template, $data);
    }

    /**
     * Gets the action to specifiy what you want to do. 
     */
    public function getRoute(){
        $route = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);
        return $route;        
    }
    
}

?>