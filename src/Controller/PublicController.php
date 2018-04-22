<?php 

use Core\Container\BaseController;

Class PublicController extends BaseController{
    public function IndexAction(){
        $this->render('web/view/test.crl.html', ['test'=>'hello']);
    }
}

?>