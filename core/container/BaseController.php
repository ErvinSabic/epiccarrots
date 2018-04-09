<?php 

namespace Core\Container; 

class BaseController{

    public function render($template, $data = null){
        if(file_exists($template)){
            $file = file_get_contents($template);
            \preg_replace_callback("#{(.*)}#", "callback",$file);
        }
        else {
            throw New Exception ("The file was not found");
        }
    }
}

?>