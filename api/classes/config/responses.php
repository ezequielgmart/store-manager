<?php

    class Responses{

        public function code_200($json="", $code=200){

            http_response_code($code);

            if ($json != "") {
                $this->define_response_content($code,$json);
            } else {
                $this->define_response_content($code,"Ok");

            }
            


        }
        public function code_201($json="", $code=201){

            http_response_code($code);

            if ($json != "") {
                $this->define_response_content($code,$json);
            } else {
                $this->define_response_content($code,"Created");

            }
            


        }
        public function code_401($json="", $code=401){

            http_response_code($code);

            if ($json != "") {
                $this->define_response_content($code,$json);
            } else {
                $this->define_response_content($code,$json);

            }
            


        }
        public function code_500($json="", $code=500){

            http_response_code($code);

            if ($json != "") {
                $this->define_response_content($code,$json);
            } else {
                $this->define_response_content($code,"Something went wrong");

            }
            


        }
       
        private function define_response_content($code,$msg){
           $body = array();
            
           $body["code"] = $code;
           $body["msg"] = $msg;
        
           echo json_encode($body);

        }

        /*
            IN THIS WAY WE GONNA BE ABLE TO GET MORE INFORMATION REGARDING THE HTTP ERRORS AND WHAT EXACTCLY MEANS!
        
        */

            # USERS 
            public function user_created(){
                $this->code_201("New user added.");

            }
            public function user_created_error(){
                $this->code_500("Something went wrong adding the new user. Please try again");

            }


            /* AUTH */
            public function login_error(){
                $this->code_401("Email or Password incorrect. Please try again.");
            }
            public function login_ok($json){
                $this->code_200($json);
            }
            public function token_ok($json){
                $this->code_200($json);
            }
            public function token_error(){
                $this->code_401("This token is disabled or doesn't exists.");
            }
            public function tokenStatusChanged(){
                $this->code_201("Token status changed to disabled");
            }
    }


?>