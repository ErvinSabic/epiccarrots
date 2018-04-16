<?php 

namespace Core\Container; 

class BaseController{
    public function __construct($request){
        
    }

    /**
     * Render a file and replace all parmas with curly brackets 
     */
    public function render($template, $data = null){
        if(file_exists($template)){
            $file = file_get_contents($template);
            var_dump($file);
            if($data != null){
                foreach($data as $item){
                    \preg_replace_callback("#{(.*)}#", "callback",$file);
                }
            }
        }
        else {
            throw New Exception ("The file was not found");
        }
    }

    /**
     * Gets the action to specifiy what you want to do. 
     */
    public function getRoute(){
        $route = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        return $route;        
    }
    
}

?>