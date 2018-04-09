<?php 

require('core/container/BaseController.php');
require('core/data/Connection.php');
require('core/routing/routing.php');
require('core/data/BaseRepository.php');
require('core/data/BaseEntity.php');

use Core\Container\BaseController;
use Core\Data\BaseEntity;
use Core\Routing\Route;
use Core\Data\Connection;
use Core\Data\BaseRepository;

$route = new Route();
$connection = new Connection();

$route->add('/');
$route->add('/about');
$route->add('/contact');

var_dump($route);
var_dump($connection->getConnection());

class ContactRepository extends BaseRepository {
    public function __construct(){
        parent::__construct("Contact");
    }
}
$contactRepo = new ContactRepository;

class ContactEntity extends BaseEntity{
    public function __construct($item){
        parent::__construct($item);
    }
}
$contactEntity = new ContactEntity($contactRepo);
var_dump($contactRepo);
var_dump($contactEntity);
?>