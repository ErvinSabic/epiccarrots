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
$connection = new Connection();

$route->add('/');
$route->add('/about');
$route->add('/contact');

var_dump($route);
var_dump($connection->getConnection());

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