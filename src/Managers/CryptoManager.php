<?php 

use Core\Data\BaseManager;
use Core\Data\APIRequest;

class CryptoManager extends BaseManager{
    function __construct($params){
        parent::__construct($params);
    }

    public function getNameFromId($cryptoId, $requestManager){
        $request = "https://api.coinmarketcap.com/v1/ticker/".$cryptoId."/";
        $data = $requestManager->getRequest($request);
        $ret = $data[0]->name;
        return $ret;
    }
}

?>