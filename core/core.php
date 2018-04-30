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
    require_once('data/RepositoryLoader.php');    
    /**
     * Security
     */
    require_once('security/SessionManager.php');
    require_once('security/PasswordHasher.php');
    require_once('security/TokenGenerator.php');
    /**
     * Rendering 
     */
    require_once('templating/RenderEngine.php');
    require_once('templating/TemplateFunctions.php');
?>