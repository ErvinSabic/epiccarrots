<?php 
    class User {
        public $id;

        public $username;

        public $email;

        public $role;

        public $password; 

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function setUsername($username){
            $this->username = $username;
            return $this;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setEmail($email){
            $this->email = $email;
            return $this;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setRole($role){
            $this->role = $role;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
            return $this;
        }

    }
?>