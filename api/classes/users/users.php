<?php
    require ("control.php");
    // require ("auth.php");
    class Users{
        private $table = "users";
        private $subTable = "";

        # GET
        public function get($token){

            $_response = new Responses();
            $_control = new Control();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
                    
                    $body = array();
                    $body = $_control->getAll($this->table);
                    $_response->get_users_ok($body);
           
            } else {
                $_responses->token_error();
            }
            
        }

        public function getById($token,$id){

            $_response = new Responses();
            $_control = new Control();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
                    
                    $body = array();
                    $body = $_control->getById($this->table,$id);
                    $_response->get_users_ok($body);
           
            } else {
                $_responses->token_error();
            }
            
        }

        public function post($json,$token){
            $_control = new Control();
            $_responses = new Responses();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
                array_push($json,$this->newId());
    
                $result = $_control->newUSer($this->table,$json);
                if ($result !=1) {
                    $_responses->user_created_error();
                } else {
                    
                    $_responses->user_created();
    
                }
           
            } else {
                $_responses->token_error();
            }
            

         
            
        }

        public function login($json){
            $_responses = new Responses();
            $_control = new Control();

            $result = $_control->login($this->table,$json);
          
           
            
        }

        public function validateToken($json){
            $_responses = new Responses();
            $_control = new Control();

            $result = $_control->validateToken($json);

        }
        public function changeTokenStatus($json){
            $_responses = new Responses();
            $_control = new Control();

            $result = $_control->disableToken($json);
        }

        private function json($body){
            echo json_encode($body);
        }

        private function newId(){ 
           
            $firstNumber = rand(1,1000);
            $secondNumber = rand(1,10000);
            $thirdNumber = rand(1,20);
            $ran = $firstNumber+$secondNumber+$thirdNumber;

            return md5($ran . " " . date("F j, Y, g:i a"));
        }
    }
  



?>