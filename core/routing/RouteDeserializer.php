<?php 
namespace Core\Routing;

class RouteDeserializer{

    public function ProcessRequest($options)
    {
        $registered = fopen('./app/config/routing.json', 'r') or die('routing.json not found or insufficent file permissions');
        $registeredData = fread($registered, filesize('./app/config/routing.json'));
        $routes = json_decode($registeredData)->routes;
        $requested = $options['route'];

        if(!isset($routes->$requested))
        /** Check to see if route exists */
        {
            die('Route not found. Did you set the route within the routing file?');
        }

        $response = $routes->$requested;        

        if($options['method'] != $response->requiredRequestType)
        /** Check to see if the proper request type is being made*/
        {
            die('Incorrect Request Method');
        }

        /** Check to see if the file exists */
        if(!file_exists($response->file)){
            die($response->file." Does not exist. Check to see if file is there and check for file permissions");
        }
        else{
            include_once($response->file);            
        }

        /** Check to see if the requested class exists */
        if(!class_exists($response->class)){
            die($response->class. " Does not exist. Did you misspell the class name within the routing file?");
        }else {
            $ret = new $response->class;
        }

        /** Fire associated function */
        $function = $response->function;
        return $ret->{$function}($options['data']);

    }
}

?>