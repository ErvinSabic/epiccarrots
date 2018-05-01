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
        $data = $API->getRequest("https://api.coinmarketcap.com/v1/ticker/?limit=0");
        $this->render("web/view/cryptos.ba.html", ['cryptos'=>$data]);
    }

    /**
     * @Route("/cryptos/view/")
     */
    public function CryptoDetailAction(){
        $coin = $this->getURLData()['coin'];
        $APIManager = new APIManager;        
        $APIData = $APIManager->getRequest("https://api.coinmarketcap.com/v1/ticker/".$coin."/");
        $cryptoManager = $this->getManager("Crypto");
        $backerManager = $this->getManager("Backer");
        $reviewManager = $this->getManager("Review");
        $backers = $backerManager->findBy('crypto_market_id', $coin);
        $reviews = $reviewManager->findBy('crypto_id', $coin);

        $data = $cryptoManager->findBy('coin_market_id', $coin);
        if(isset($data[0])){
            $data = $data[0];
            $data['backerCount'] = count($backers);
            $data['reviewCount'] = count($reviews);
        }else {
            //Make a new one if you can't find it.
            $crypto = New Crypto;
            $crypto->setName($APIData[0]->name);
            $crypto->setTicker($APIData[0]->symbol);
            $crypto->setScamCoin("Unknown");
            $crypto->setCoinMarketId($APIData[0]->id);
            $cryptoManager->persist($crypto);
            $data = $cryptoManager->findBy('coin_market_id', $coin);       
            $data['backerCount'] = count($backers);
            $data['reviewCount'] = count($reviews);  
        }

        $data = array_merge($data, (array) $APIData[0], ['backers'=>$backers]);
        return $this->render("web/view/cryptos/detail.ba.html", $data);

    }

    /**
     * @Route("/cryptos/reviews/")
     */
    public function CryptoReviewsIndexAction(){
        $urlData = $this->getURLData();
        $reviewManager = $this->getManager("Review");
        $userManager = $this->getManager("User");
        $cryptoManager = $this->getManager("Crypto");
        $APIManager = new APIManager;                
        $reviews = [];

        if(isset($urlData['coin'])){
            $coin = $this->getURLData()['coin'];
            $data = $reviewManager->findBy('crypto_id', $coin);
        }else {
            $data = $reviewManager->findAll();
        }
        foreach($data as $item){
            $user = $userManager->find($item['user_id']);
            $cryto = 
            $author = $user['username'];
            $item = array_merge($item, [
                'author'=>$author,
                'crypto_name'=> $cryptoManager->getNameFromId($item['crypto_id'], $APIManager)
            ]);
            array_push($reviews, $item);
        }
        return $this->render("web/view/review/review.ba.html", ['reviews'=>$reviews]);
    }

    /**
     * @Route("/cryptos/backers/add")
     */
    public function CryptoBackerAddAction(){
        $data = $this->getURLData();
        $cryptoId = $data['coin'];
        return $this->render("web/view/backer/add.ba.html", ['cryptoId'=>$cryptoId]);
    }

    /**
     * @Route("/cryptos/backers/addAttempt")
     */
    public function CryptoBackerAddActionAttempt(){
        $backerManager = $this->getManager("Backer");
        $backer = new Backer;
        $data = $this->getData();
        $backer->setName($data['name']);
        $backer->setCryptoMarketId($data['crypto_market_id']);
        $backer->setWebsite($data['website']);
        $backer->setDescription($data['description']);
        $backerManager->persist($backer);
        $this->redirect("./");
    }

    /**
     * @Route("/cryptos/backers/edit")
     */
    public function CryptoBackerEditAction(){
        $urlData = $this->getURLData();
        $id = $urlData['id'];
        $backerManager = $this->getManager("Backer");
        $data = $backerManager->find($id);
        return $this->render("web/view/backer/edit.ba.html", $data);
    }

    /**
     * @Route("/cryptos/backers/editAttempt")
     */
    public function CryptoBackerEditActionAttempt(){
        $backerManager = $this->getManager("Backer");
        $backer = new Backer;
        $data = $this->getData();
        $backer->setId($data['id']);
        $backer->setName($data['name']);
        $backer->setCryptoMarketId($data['crypto_market_id']);
        $backer->setWebsite($data['website']);
        $backer->setDescription($data['description']);
        $backerManager->update($backer);
        return $this->redirect("./");
    }

    /**
     * @Route("/cryptos/reviews/add")
     */
    public function CryptoReviewAddAction(){
        $data = $this->getUrlData();
        $cryptoId = $data['coin'];
        return $this->render("web/view/review/add.ba.html", ['cryptoId' => $cryptoId]);
    }

    /**
     * @Route("/cryptos/reviews/addAttempt")
     */
    public function CryptoReviewAddActionAttempt(){
        if($this->getCurrentLoggedInID()){
            $reviewManager = $this->getManager("Review");
            $review = New Review;
            $data = $this->getData();
            $review->setTitle($data['title']);
            $review->setTextBody($data['text_body']);
            $review->setUserId($this->getCurrentLoggedInID());
            $review->setCryptoId($data['crypto_id']);
            $reviewManager->persist($review);
            $this->redirect("./?route=/cryptos/reviews/");
        }
    }
    /**
     * @Route("/cryptos/reviews/edit/")
     */
    public function CryptoReviewEditAction(){
        if($id = $this->getCurrentLoggedInID()){
            $urlData = $this->getUrlData();
            $reviewId = $urlData['id'];
            $reviewManager = $this->getManager("Review");
            $userManager = $this->getManager("User");
            $review = $reviewManager->find($reviewId);
            $editorId = $review['user_id'];
            if($id == $editorId){
                return $this->render("web/view/review/edit.ba.html", $review);
            }else {
                die("You cannot edit this.");
            }
        }
    }

    /**
     * @Route("/cryptos/reviews/editAttempt")
     */
    public function CryptoReviewEditActionAttempt(){
        $reviewManager = $this->getManager("Review");
        $review = New Review;
        $data = $this->getData();
        $review->setId($data['id']);
        $review->setTitle($data['title']);
        $review->setTextBody($data['text_body']);
        $review->setUserId($this->getCurrentLoggedInID());
        $review->setCryptoId($data['crypto_id']);
        $reviewManager->update($review);
        $this->redirect("./?route=/cryptos/reviews/view/&id=".$review->getId());
    }
    /**
     * @Route("/cryptos/reviews/view/")
     */
    public function CryptoReviewsDetailAction() {
        $urlData = $this->getUrlData();
        $reviewId = $urlData['id'];
        $reviewManager = $this->getManager("Review");
        $userManager = $this->getManager("User");

        $data = $reviewManager->find($reviewId);
        $data['author'] = $userManager->find($data['user_id'])['username'];
        $data['allow_edit'] = '';
        if($userManager->find($data['user_id'] == $this->getCurrentLoggedInID())){
            $data['allow_edit'] = "Yes";
        }

        return $this->render("web/view/review/detail.ba.html", $data);
    }
    /**
     * @Route("/contact")
     */
    public function ContactAction(){
        $this->render("web/view/contact.ba.html");
    }
}

?>