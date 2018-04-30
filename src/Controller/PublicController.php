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
        $commentManager = $this->getManager("Comment");
        $dump = $commentManager->findAll();
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
        $API = new APIManager;
        $data = $API->getRequest("https://api.coinmarketcap.com/v1/ticker/");
        $this->render("web/view/cryptos.ba.html", ['cryptos'=>$data]);
    }

    /**
     * @Route("/cryptos/view/")
     */
    public function CryptoDetailAction(){
        $coin = $this->getURLData()['coin'];
        $manager = $this->getManager("Crypto");
        $data = $manager->findBy('ticker', $coin);
    }

    /**
     * @Route("/contact")
     */
    public function ContactAction(){
        $this->render("web/view/contact.ba.html");
    }
}

?>