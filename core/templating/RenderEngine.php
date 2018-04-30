<?php 
namespace Core\Templating;

use Core\Templating\TemplateFunctions;
use Core\Security\SessionManager;

class RenderEngine{

    protected $availableFunctions;

    protected $file;

    protected $data;
    /**
     * @param string $template
     * @param array $data
     */
    public function render($template, $data = ['']){
        $security = new SessionManager;
        if($security->checkIfLoggedIn()){
            $data = array_merge($data, ['USER_Username'=>$_SESSION['Username'], 'USER_NoUser'=>False]);
        }else {
            $data = array_merge($data, ['USER_Username'=>null, 'USER_NoUser'=>True]);
        }
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
        }else {
            $this->data = $data;
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
        $ret = $this->runFunctions($functionInstances[0], $data);
        return eval('?>' .$ret->getRenderedResult(). '<?php');
    }

    /**
     * @param string $function
     * @param array $data
     */
    public function runFunctions($pregString, $data = null){
        $engine = new TemplateFunctions($this->file);
        $engine->setData($this->data);
        $this->availableFunctions = $engine->getAvailableFunctions(true);
        $checked = [];
        foreach($pregString as $string){
            if((isset($checked[$string]))){
                continue;
            }
            else {
                foreach($this->availableFunctions as $item){
                    if(strpos($string, $item) !== false && !isset($checked[$string])){
                        $checked[$string]='Checked';
                        $engine->serveFunction($item, $string);
                    }else {
                        continue;
                    }
                }
            }
        }
        return $engine;
    }

    /**
     * 
     */
    public function getAvailableFunctions(){
        return $this->availableFunctions;
    }
    }

?>