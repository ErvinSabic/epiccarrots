<?php 

use Core\Container\BaseController;
use Core\Data\APIManager;

Class PublicController extends BaseController{
    /**
     * @Route("/")
     */
    public function IndexAction(){
        $APIManager = new APIManager;
        $data = $APIManager->getRequest('https://api.coinmarketcap.com/v1/ticker/?limit=5');
        return $this->render('web/view/home.ba.html', ['cryptos'=>$data]);
    }

    /**
     * @Route("/about")
     */
    public function AboutAction(){
        $this->render("web/view/about.ba.html");
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