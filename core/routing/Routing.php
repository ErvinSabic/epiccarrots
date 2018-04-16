<?php 
namespace Core\Routing;

use Core\Routing\RouteDeserializer;

class Route {
    public $route;

    /**
     * @param string $route
     */
    public function __construct($route = null){
        if($route == null){
            $this->route = '';
        }
        else{
            $this->route = $route;
        }
    }

    /**
     * Get current route
     */
    public function getRoute(){
        return $this->route;
    }
}