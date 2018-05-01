<?php 

class Backer {
    public $id;

    public $name; 

    public $website; 

    public $description;

    public $crypto_market_id;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setWebsite($website){
        $this->website = $website; 
        return $this;
    }

    public function getWebsite(){
        return $this->website;
    }

    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    public function getCryptoMarketId(){
        return $this->crypto_market_id;
    }
    
    public function setCryptoMarketId($crypto_market_id){
        $this->crypto_market_id = $crypto_market_id;
        return $this;
    }
}

?>