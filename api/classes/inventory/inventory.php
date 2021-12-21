<?php
    require "../classes/users/control.php";
    require "control.php";


    
    class Inventory{
        public $control;
        public $responses;
        public $users;

        public function __construct() {
            $this->control = new InventoryControl();
            $this->responses = new Responses();
            $this->users = new UsersControl();
        }
        public function get($token,$criteria ="",$json=""){

                # validate the token we are working with 
                $tokenVerify = $this->users->validateToken($token);
                if ($tokenVerify != 0) {

                    # if the token is good
                    if ($json == "" || $criteria == "") {
                         
                        $result = $this->control->get();
                        if (!empty($result)) {
                            $this->responses->get_ok($result);
                        } else {
                            $this->responses->no_content();

                        }
                        
                    } else {
                        
                        $result = $this->control->get($criteria,$json);
                        if (!empty($result)) {
                            $this->responses->get_ok($result);
                        } else {
                            $this->responses->no_content();

                        }
                    }
                    
            

                } else {
                    # else token aint good
                    $this->responses->token_error();
                }
            
            
        }

        public function post($token,$json,$type){
          
            # validate the token we are working with 
            $tokenVerify = $this->users->validateToken($token);

            if ($tokenVerify != 0) {

                if ($type == 1 ) {
                    # if the token is good
                    $result = $this->control->buy($json);

                        if ($result !=1) {
                            $this->responses->server_error();
                        } else {
                            
                            $this->responses->created();
            
                        }
                } else if ($type == 2){

                    $result = $this->control->sell($json);
                        if ($result !=1) {
                            $this->responses->server_error();
                        } else {
                            
                            $this->responses->created();
            
                        }
                } else if ($type > 2 || $type < 1){

                    $this->responses->missing();

                }
                
            } else {
                # else token aint good
                $this->responses->token_error();
            }

        } 

        public function delete($token,$json){
            

            # validate the token we are working with 
            $tokenVerify = $this->users->validateToken($token);

            if ($tokenVerify != 0) {


                # if the token is good
                $result = $this->control->delete($json);

                if ($result > 0) {
                    $this->responses->delete();
                } else {
                    
                  $this->responses->non_delete();
    
                }

       
            } else {
                # else token aint good
                $this->responses->token_error();
            }

        } 

      
    
    }

?>