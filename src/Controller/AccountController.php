<?php 

use Core\Container\BaseController;

Class AccountController extends BaseController {
    /**
     * @Route("/login")
     */
    public function LoginAction(){
        return $this->render("web/view/account/login.ba.html");
    }

    /**
     * @Route("/loginAttempt")
     */
    public function LoginAttemptAction(){
        $userManager = $this->getManager("User");
        $attempt = $this->getData();
        //$this->redirect("./?route=/login");
    }
    /**
     * @Route("/logout")
     */
    public function LogoutAction(){

    }

    /**
     * @Route("/signup")
     */
    public function SignupAction(){
        return $this->render("web/view/account/signup.ba.html");
    }
}
?>