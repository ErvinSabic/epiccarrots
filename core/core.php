<?php 
/**
 * Make sure all depenencies are included.
 */
    /**
     * Container Objects
     */
    require_once('container/BaseController.php');
    require_once('routing/Routing.php');
    require_once('routing/RouteDeserializer.php');
    /**
     * Data Objects
     */
    require_once('data/Connection.php');
    require_once('data/BaseManager.php');
    require_once('data/APIRequest.php');
    require_once('http/Request.php');
    /**
     * Rendering 
     */
    require_once('templating/RenderEngine.php');
    require_once('templating/TemplateFunctions.php');
?>