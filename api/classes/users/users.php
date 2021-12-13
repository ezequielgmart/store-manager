<?php
    require ("control.php");
    // require ("auth.php");
    class Users{
        private $table = "users";
        private $subTable = "";

        # GET ALL USERS
        public function get($token){

            $_response = new Responses();
            $_control = new UsersControl();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
                    
                    $body = array();
                    $body = $_control->getAll($this->table);
                    $_response->get_users_ok($body);
           
            } else {
                $_responses->token_error();
            }
            
        }

        # GET A USER BY ID
        public function getById($token,$id){

            $_response = new Responses();
            $_control = new UsersControl();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
                    
                    $body = array();
                    $body = $_control->getById($this->table,$id);
                    $_response->get_users_ok($body);
           
            } else {
                $_responses->token_error();
            }
            
        }

        # ADD A NEW USER
        public function post($json,$token){
            $_control = new Control();
            $_responses = new UsersControl();
            
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
        # Delete user
        public function delete($json,$token){

            $_control = new Control();
            $_responses = new UsersControl();
            
            $tokenVerify = $_control->validateToken($token);

            if ($tokenVerify != 0) {
    
              $result = $_control->deleteUser($this->table,$json);

              if ($result > 0) {
                  # code...
                    $_responses->delete_ok();
              } else {

                  $_responses->delete_error();
              }
              
           
            } else {
                $_responses->token_error();
            }
            
        }


        # INTERFACE WITH THE CONTROL->LOGIN
        public function login($json){
            $_responses = new Responses();
            $_control = new UsersControl();

            $result = $_control->login($this->table,$json);
          
           
            
        }

        # VALIDATE A TOKEN
        public function validateToken($json){
            $_responses = new Responses();
            $_control = new UsersControl();

            $result = $_control->validateToken($json);

        }
        // DISABLED A TOKEN
        public function changeTokenStatus($json){
            $_responses = new Responses();
            $_control = new UsersControl();

            $result = $_control->disableToken($json);
        }

        # ECHO JSON ENCODE
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

        public function error_no_token(){
            $_responses = new Responses();

            $_responses->token_error();

        }

        public function error_no_id(){
            $_responses = new Responses();

            $_responses->user_no_id();
        }
    }
  



?>