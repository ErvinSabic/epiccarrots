<?php 

use Core\Container\BaseController;
use Core\Data\APIManager;

Class PublicController extends BaseController{
    /**
     * @Route("/")
     */
    public function IndexAction(){
        $connection = $this->getConnection();
        $this->render('web/view/home.ba.html', ['test'=>'hello']);
    }

    /**
     * @Route("/about")
     */
    public function AboutAction(){
        $this->render("web/view/about.ba.html", ['test'=>'test']);
    }

    /**
     * @Route("/cryptos")
     */
    public function CryptoAction(){
        $this->render("web/view/cryptos.ba.html");
    }

    /**
     * @Route("/contact")
     */
    public function ContactAction(){
        $this->render("web/view/contact.ba.html");
    }
}

?>