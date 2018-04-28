<?php 
namespace Core\Templating;

use Core\Templating\TemplateFunctions;

class RenderEngine{

    protected $availableFunctions = [
        'extends',
        'foreach', 
        'endblock',
        'endif',
        'if', 
        'block'
    ];

    protected $file;

    /**
     * @param string $template
     * @param array $data
     */
    public function render($template, $data = null){
        /** Check to see if file exists */
        if(!file_exists($template)){
            die("Template file does not exist. File: ".$template);
            return false;
        }
        $this->file = file_get_contents($template);
        /**
         *  Check to see if file has data associated with it 
         * 
         */
        if($data == null){
            return $this->file;
        }
        foreach($data as $itemKey=>$itemValue){
            /**
             * Avoid getting an exception trying to render an array
             */
            if(! is_array($itemValue)){
                $this->file = \preg_replace("/\{\{".$itemKey."\}\}/",htmlspecialchars($itemValue),$this->file);
            }
        }
        /**
         * FUNCTIONS CHECK
         */
        $functions = preg_match("/\{\% .* \%\}/", $this->file, $functionInstances);
        var_dump($functionInstances);
        foreach($functionInstances as $itemKey => $itemValue){
            $this->checkFunction($itemValue);
        }
        return eval('?>' . $this->file . '<?php');
    }

    /**
     * @param string $function
     */
    public function checkFunction($pregString){

        foreach($this->availableFunctions as $item){
            $check = strpos($pregString, $item);
            if($check !== false){
                $this->runFunction($item);
            }else {
                echo "Template engine function exception: function ".$pregString." Not found. <br>";
            }
        }
    }

    /**
     * @param string $function 
     * @param array $params
     */
    public function runFunction($function, $params = null){
        $functionEngine = new TemplateFunctions;
    }

    /**
     * 
     */
    public function getAvailableFunctions(){
        return $this->availableFunctions;
    }
    }

?>