<?php 
namespace Core\Templating;

Class TemplateFunctions {

    protected $content;
    
    protected $data; 

    /**
     * Put the ones that end your function first. THEY MATTER
     */
    protected $availableFunctions = [
        'extends' => 'renderMaster',
        'endblock' => 'renderEndblock',
        'block' => 'renderBlock',
        'endforeach'=>'renderEndForeach',
        'foreach' => 'renderForeach',
        'endif' => 'renderEndif',         
        'if' => 'renderIf',
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
        /**$play = "<strong>Function String: </strong>".$functionString."<strong> Location:</strong>".$location. "<br>";
        echo $play; */
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
    public function renderForeach($functionString, $location){
        $realKeys = [];
        if($this->data == null){
            die('Template Function Exception: You cannot fire a foreach statement without data');
        }
        $match = preg_match("/\{\% foreach .*. as .* \%\}/", $this->content, $param);
        foreach($param as $item){
            $filter = preg_match("/\'.*\'/", $item, $options);  
            $foreachParams = array_filter(explode("'", $options[0]));
        }

        $requestedData = $foreachParams[1];
        $displayed = $foreachParams[3];
        if(!isset($this->data[$requestedData])){
            die("Template Function Exception: The variable '$requestedData' in the foreach is not being returned or setup properly. Did you misspell it?");
        }
        if(!is_array($this->data[$requestedData])){
            die("Template Function Exception: The variable '$requestedData' in the foreach statement is not an array");
        }
        $innerRequest = $this->get_string_between($this->content, $param[0], "{% endforeach %}" );
        $innerMatch = preg_match_all("/\{".$displayed."\..*\}/", $innerRequest, $foreachMatches);
        
        $prefix = $displayed;       
        $ret = '';
        foreach($foreachMatches[0] as $real){
            $a = str_replace("{".$prefix.".","",$real);
            $b = str_replace("}","",$a);
            $realKeys[$real]= $b;
        };
        $i = 0;
        while($i != count($this->data[$requestedData])){
            $ret = $ret.$innerRequest;            
            $currentData = (array) $this->data[$requestedData][$i];
            foreach($realKeys as $realKey=>$realData){
                $ret = str_replace($realKey, $currentData[$realData], $ret);
            }
            $i++;
        }
        foreach($param as $item){
            $this->content = str_replace($item, "", $this->content);
            $this->content = str_replace("{% endforeach %}", "", $this->content);
        }
        $this->content = str_replace($innerRequest, $ret, $this->content);
        
    }

    /**
     * @param string $functionString
     * @param string $location
     */
    public function renderEndforeach(){
        /** Leave blank, this is here to keep things in order for the other functions */
    }

    public function renderEndBlock(){
        /** Leave blank, this is here to keep things in order for the other functions */
    }

    public function renderEndIf(){
        /** Leave blank, this is here to keep things in order for the other functions */
    }

    public function renderIf($functionString, $location){
        $match = preg_match("/\{\% if \(.*\) \%\}/", $this->content, $matches); {
            foreach($matches as $item){
                $conditionMatch = preg_match("/\(.*\)/", $item, $condition);
                $conditionalData = $this->get_string_between($this->content, $item, "{% endif %}");
                $a = str_replace("(", "", $condition[0]);
                $b = str_replace(")" ,"", $a);
                $condition[0] = $b;
                if(isset($this->data[$condition[0]])){
                    $this->content = str_replace($location, '', $this->content);
                    $this->content = str_replace("{% endif %}", '', $this->content);
                }else {
                    $this->content = str_replace($location, '', $this->content);
                    $this->content = str_replace("{% endif %}", '', $this->content);
                    $this->content = str_replace($conditionalData, '', $this->content);
                }
            }
        }
    }

    public function renderBlock(){
        /** Leave blank, this is here to keep things in order for the other functions */
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
        foreach($replace as $block){
            $blockName = preg_match("/\'.*\'/", $block, $blockRenderedTemp);
            $endTag = "{% endblock ".$blockRenderedTemp[0] ." %}";
            $replacement = $this->get_string_between($this->content,$block,$endTag);
            $this->content = preg_replace("/\{\% block ".$blockRenderedTemp[0]." \%\}/", $replacement, $master);
        }
    }

    /**
     * Gets information between two starting and ending tags
     */

    public function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        $ini += strlen($start);   
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
    
    public function getRenderedResult(){
        echo $this->content;
    }
}

?>