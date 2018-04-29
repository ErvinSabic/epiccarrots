<?php 

use Core\Container\BaseController;

Class PublicController extends BaseController{
    public function IndexAction(){
        $sampledata = [
            [
                'name'=>'name',
                'email'=>'esabic@gearsite.net',
                'address'=>'address'
            ],
            [
                'name'=>'name',
                'email'=>'elvishigh17@live.com',
                'address'=>'other address'
            ]
        ];
        $this->render('web/view/test.ba.html', ['test'=>'hello', 'thing1'=>$sampledata]);
    }
}

?>