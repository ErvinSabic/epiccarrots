<?php 
namespace Core\Templating;

use Core\Templating\TemplateFunctions;

class RenderEngine{

    protected $availableFunctions = [

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
         * Run through functions engine
         */
        $functions = preg_match_all("/\{\% .* \%\}/", $this->file, $functionInstances);
        $this->runFunctions($functionInstances[0], $data);
        return eval('?>' . $this->file . '<?php');
    }

    /**
     * @param string $function
     * @param array $data
     */
    public function runFunctions($pregString, $data = null){
        $checked = [];
        foreach($pregString as $string){
            if((isset($checked[$string]))){
                continue;
            }
            else {
                foreach($this->availableFunctions as $item){
                    if(strpos($string, $item) !== false and !isset($checked[$string])){
                        $checked[$string]='Checked';
                        $this->executeFunction($item, $string);
                    }else {
                        continue;
                    }
                }
            }
        }
    }

    /**
     * @param string $function 
     * @param array $params
     */
    public function executeFunction($function, $params = null){
        $functionEngine = new TemplateFunctions($this->file);
        
    }

    /**
     * 
     */
    public function getAvailableFunctions(){
        return $this->availableFunctions;
    }
    }

?>