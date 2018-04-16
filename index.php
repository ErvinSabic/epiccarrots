<?php 
    /**
     * DEV ENV
     */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /**
     * END DEV ENV
     */

    require('core/core.php');
    use Core\Container\BaseController;
    use Core\Data\BaseManager;
    use Core\Routing\Route;
    use Core\Data\Connection;
    use Core\Http\Request;

    if(isset($_GET['route'])){
        $route = new Route($_GET['route']);        
    }
    else{
        $route = new Route;        
    }
    $request = new Request($route->getRoute());
    $requestData = [
        'route'=>$route, 
        'data'=>$_POST, 
        'method'=>$_SERVER['REQUEST_METHOD']
    ];
    $request->setOptions($requestData);
    echo '<pre>';    
    var_dump($request);
    echo '</pre>';    
?>