<?php 
namespace Core\Templating;

Class TemplateFunctions {

    protected $content;
    
    protected $data; 

    /**
     * Put the ones that end your function first. THEY MATTER
     */
    protected $availableFunctions = [
        'end foreach'=>'renderEndForeach',
        'end block' => 'renderEndblock',
        'end if' => 'renderEndif',
        'extends' => 'renderMaster',
        'foreach' => 'renderForeach', 
        'if' => 'renderIf',
        'block' => 'renderBlock' 
    ];

    public function __construct($page){
        $this->content = $page;
    }

    /**
     * @param $array $data
     */
    public function setData($data){
        $this->data = $data;
    }

    /**
     * @param boolean $keys
     */
    public function getAvailableFunctions($keys = false){
        if($keys == false){
            return $this->availableFunctions;
        }
        else {
            $ret = [];
            foreach($this->availableFunctions as $key => $value){
                array_push($ret, $key);
            }
            return $ret;
        }
        
    }

    /**
     * @param string $functionString
     * @param string $location
     */
    public function serveFunction($functionString, $location){
        /**
         * DEV ONLY 
         *
         *$play = "<strong>Function String: </strong>".$functionString."<strong> Location:</strong>".$location. "<br>";
         *echo $play;
         *
         * END DEV ONLY 
         */
        if(!isset($this->availableFunctions[$functionString])){
            die("Template Function Exception: '". $functionString. "' Could not be served. Did you misspell the function or not include it as an available function?");
        }
        $function = $this->availableFunctions[$functionString];
        $this->$function($functionString, $location);
    }

    /**
     * @param string $functionString
     * @param string $location
     */
    public function renderMaster($functionString, $location){
        $masterLocation = preg_match("/\'.*\'/", $location, $locationString);
        if(count($locationString) > 1){
            die('Template Function Exception: You cannot have more than 1 master function.');
        }
        $fileLocation = str_replace("'", "",$locationString[0]);
        if(!file_exists($fileLocation)){
            die('Template Function Exception: Extends function file could not be found. Did you misspell it? Maybe PHP does not have access to the file.');
        }
        $masterContents = file_get_contents($fileLocation);
        $this->renderBlocks($masterContents, $this->content);

        
    }

    /**
     * @param string $functionString
     * @param string $location
     */
    public function renderForeach(){
        if($this->data == null){
            die('Template Function Exception: You cannot fire a foreach statement without data');
        }
    }

    /**
     * @param string $functionString
     * @param string $location
     */
    public function renderEndforeach(){

    }

    public function renderEndBlock(){

    }

    public function renderEndIf(){

    }

    public function renderIf(){

    }

    public function renderBlock(){

    }

    /**
     * @param string $master 
     * @param string $sub
     */
    public function renderBlocks($master, $sub){
        /**
         * Find block locations on master
         */
        $match = preg_match("/\{\% block .* \%\}/", $master, $replace);
        $blockMatch = preg_match("", $sub, $data);
        foreach($replace as $block){
            $blockName = preg_match("/\'.*\'/", $block, $blockRenderedTemp);
            $endTag = "{% end block '".$blockRenderedTemp[0] ."' %}";
            $replacement = $this->get_string_between($sub,$block,$endTag);
            var_dump($replacement);
        }
    }

    function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        $ini += strlen($start);   
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
}

?>