<?php 
namespace Core\Routing;

class Route {
    private $url = [];

    /**
     * @param $url
     */
    public function add($url){
        $this->_url[] = $url;
    }

    public function submit(){
        $url = isset($_GET['url']) ? $_GET['url'] : '/';

        foreach ($this->_url as $key => $value){
            if (preg_match("#^$value#", $url))
            {
                echo "MATCH!";
            }
        }
    }
}