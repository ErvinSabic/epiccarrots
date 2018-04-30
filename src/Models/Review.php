<?php 

class Review {
    public $id; 

    public $crypto_id;

    public $user_id;

    public $text_body;

    public $title;

    public function getId(){
        return $this->id;
    }

    public function getCryptoId(){
        return $this->crypto_id;
    }

    public function setCryptoId($crypto_id){
        $this->crypto_id = $crypto_id;
        return $this;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
        return $this;
    }

    public function getTextBody(){
        return $this->textBody();
    }

    public function setTextBody($text_body){
        $this->text_body = $text_body;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
}

?>