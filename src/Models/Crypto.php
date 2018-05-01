<?php 

class Crypto {
    public $id;

    public $name;

    public $scam_coin;

    public $ticker;

    public $coin_market_id;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getName(){
        return $this->name;
    }
     
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getScamCoin(){
        return $this->scam_coin;
    }

    public function setScamCoin($scam_coin){
        $this->scam_coin = $scam_coin;
        return $this;
    }

    public function getTicker(){
        return $this->ticker;
    }

    public function setTicker($ticker){
        $this->ticker = $ticker;
        return $this;
    }

    public function getCoinMarketId(){
        return $this->coin_market_id;
    }

    public function setCoinMarketId($coin_market_id){
        $this->coin_market_id = $coin_market_id;
        return $this;
    }
}

?>