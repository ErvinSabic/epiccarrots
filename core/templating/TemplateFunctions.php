<?php 
namespace Core\Templating;

Class TemplateFunctions {

    protected $content;
    
    protected $availableFunctions = [
        'extends' => 'renderMaster',
        'foreach' => 'renderForeach', 
        'end foreach'=>'renderEndForeach',
        'end block' => 'renderEndblock',
        'end if' => 'renderEndif',
        'if' => 'renderIf',
        'block' => 'renderBlock' 
    ];

    public function __construct($page){
        $this->content = $page;
    }

    public function serveFunction($functionString, $location){

    }

    public function renderMaster(){

    }
    
    public function renderForeach(){

    }

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
}

?>