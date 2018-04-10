<?php 

require('core/container/BaseController.php');
require('core/data/Connection.php');
require('core/routing/routing.php');
require('core/data/BaseManager.php');

use Core\Container\BaseController;
use Core\Data\BaseManager;
use Core\Routing\Route;
use Core\Data\Connection;

$route = new Route();

$route->add('/');
$route->add('/about');
$route->add('/contact');
$route->submit();
var_dump($route);
echo("<br>");

class Contact{
    public $id; 

    public $name; 

    public $phone; 
}

class ContactManager extends BaseManager {
    public $options = [

    ];
    public function __construct(){
        parent::__construct($this->options);
    }
}
$Contact = new Contact;
var_dump($Contact);
?>