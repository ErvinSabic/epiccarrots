<?php 
namespace Core\Data;

class APIManager{
    public function getRequest($url){
        $data = file_get_contents($url);
        $ret = json_decode($data);
        return $ret;
    }

}

?>