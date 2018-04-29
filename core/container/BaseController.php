<?php 

namespace Core\Container; 

use Core\Templating\RenderEngine;
use Core\Data\RepositoryLoader; 

class BaseController{
    /**
    * Render a file and replace all parmas with curly brackets 
    */
    public function render($template, $data = ['']){
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

    /**
     * Gets PDO Connection
     */
    public function getConnection(){
        return $this->connection->getConnection();
    }

    /**
     * Gets associated manager
     */
    public function getManager($requested){
        $repositoryLoader = new RepositoryLoader; 
        $response = $repositoryLoader->loadRepository($requested);
        return $response;
    }
    
}

?>