<?php 

use Core\Container\BaseController;
use Core\Security\PasswordHasher;
use Core\Security\SessionManager;
Class AccountController extends BaseController {
    /**
     * @Route("/account")
     */
    public function AccountAction(){
        $sessionManager = new SessionManager;
        $userManager = $this->getManager("User");
        $data = $userManager->findBy('username',$sessionManager->getUsername());
        return $this->render("web/view/account/account.ba.html", $data[0]);
    }
    /**
     * @Route("/login")
     */
    public function LoginAction(){
        $sessionManager = new SessionManager;
        if($sessionManager->checkIfLoggedIn() == false){
            return $this->render("web/view/account/login.ba.html");
        }else {
            $this->redirect("./?route=/account");
        }
    }

    /**
     * @Route("/loginAttempt")
     */
    public function LoginAttemptAction(){
        $hasher = new PasswordHasher;
        $userManager = $this->getManager("User");
        $attempt = $this->getData();
        $hashedAttempt = $hasher->hashString($attempt['password']);
        $data = $userManager->findBy('username',$attempt['username']);
        if ($data[0]['password']=$hashedAttempt){
            echo "You have been signed in";
            $_SESSION['Username'] = $data[0]['username'];
            $this->redirect("./");
        } 
        else {
            echo "Bad Login Information";
            $this->redirect("./");
        }
    }
    /**
     * @Route("/logout")
     */
    public function LogoutAction(){
        $sessionManager = new SessionManager;
        $sessionManager->destroySession();
        echo "You have been successfully logged out";
    }

    /**
     * @Route("/signup")
     */
    public function SignupAction(){
        return $this->render("web/view/account/signup.ba.html");
    }

    /**
     * @Route("/signupAttempt")
     */
    public function SignupAttemptAction(){
        $data = $this->getData();
        $userManager = $this->getManager("User");
        $hasher = new PasswordHasher;
        $user = new User;
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setRole("User");
        $user->setPassword($hasher->hashString($data['password']));
        $userManager->persist($user);
        $this->redirect("./");
    }
}
?>