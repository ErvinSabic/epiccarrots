<?php 

namespace Core\Container; 

class BaseController{
    /**
     * Render a file and replace all parmas with curly brackets 
     */
    public function render($template, $data = null){
        /** Check to see if file exists */
        if(file_exists($template)){
            $file = file_get_contents($template);
            /** Check to see if file has data associated with it */
            if($data != null){
                foreach($data as $itemKey=>$itemValue){
                    $file = \preg_replace("/\{".$itemKey."\}/",$itemValue,$file);
                }
                eval('?>' . $file . '<?php');
            }
            else{
                return $file;
            }
        }
        else {
            die('File was not found');
        }
    }

    /**
     * Gets the action to specifiy what you want to do. 
     */
    public function getRoute(){
        $route = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);
        return $route;        
    }
    
}

?>