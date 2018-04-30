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

    session_name("epiccarrots");
    session_start();

    if(isset($_GET['route'])){
        $route = $_GET['route'];        
    }
    else{
        $route = '/';   
    }
    $request = new Request($route);
    $requestData = [
        'route'=>$route, 
        'data'=>$_POST, 
        'method'=>$_SERVER['REQUEST_METHOD']
    ];
    $request->setOptions($requestData);
    $ret = $request->serveRequest();
    echo '<pre>';    
    print_r($ret);
    echo '</pre>';    
?>