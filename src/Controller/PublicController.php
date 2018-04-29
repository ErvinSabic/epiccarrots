<?php 

use Core\Container\BaseController;
use Core\Data\Connection;

Class PublicController extends BaseController{
    public function IndexAction(){
        $connection = new Connection;
        $this->render('web/view/test.ba.html', ['test'=>'hello']);
    }

    public function AboutAction(){
        echo "Hi";
    }
}

?>