<?php 
namespace Core\Routing;

class Route {
    private $uri = [];

    /**
     * @param $uri
     */
    public function add($uri){
        $this->_uri[] = $uri;
    }

    public function submit(){
        $uri = isset($_GET['uri']) ? $_GET['uri'] : '/';
        echo($uri);

        foreach ($this->_uri as $key => $value){
            echo($value ."<br>");
            if (preg_match("#^$value#", $uri))
            {
                echo "MATCH!";
            }
        }
    }
}