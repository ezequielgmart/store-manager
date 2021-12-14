<?php
    require "../classes/users/control.php";
    require "control.php";


    
    class Products{
        public function get($token,$json=""){

                # The objects we gonna working with 
                $_userControl = new UsersControl();
                $_productsControl = new ProductsControl();
                $_responses = new Responses();

                # validate the token we are working with 
                $tokenVerify = $_userControl->validateToken($token);
                if ($tokenVerify != 0) {


                    # if the token is good
                    
                    # The 1 as paramenter means the first type of get which is getAll no criteria
                    if ($json == "") {
                        # if the request doesn't content any id the type of get is getAll
                        $result = $_productsControl->get(1);
                        if (!empty($result)) {
                            $_responses->get_ok($result);
                            # code...
                        } else {
                            $_responses->no_content();

                        }
                        
                    } else {
                        $result = $_productsControl->get(2,$json);
                        if (!empty($result)) {
                            $_responses->get_ok($result);
                            # code...
                        } else {
                            $_responses->no_content();

                        }
                    }
                    
            

                } else {
                    # else token aint good
                    $_responses->token_error();
                }
            
            
        }

        public function post($token,$json){
            # The objects we gonna working with 
            $_userControl = new UsersControl();
            $_productsControl = new ProductsControl();
            $_responses = new Responses();

            # validate the token we are working with 
            $tokenVerify = $_userControl->validateToken($token);

            if ($tokenVerify != 0) {


                # if the token is good
                $newId = $this->generateProductId($json);

                array_unshift($json,$newId); 

                $result = $_productsControl->add($json);

                if ($result !=1) {
                    $_responses->product_created_error();
                } else {
                    
                    $_responses->product_created();
    
                }
       
            } else {
                # else token aint good
                $_responses->token_error();
            }

        } 

        public function delete($token,$json){
            # The objects we gonna working with 
            $_userControl = new UsersControl();
            $_productsControl = new ProductsControl();
            $_responses = new Responses();

            # validate the token we are working with 
            $tokenVerify = $_userControl->validateToken($token);

            if ($tokenVerify != 0) {


                # if the token is good


                $result = $_productsControl->delete($json);

                if ($result > 0) {
                    $_responses->delete();
                } else {
                    
                  $_responses->non_delete();
    
                }

       
            } else {
                # else token aint good
                $_responses->token_error();
            }

        } 

        private function generateProductId($json){
            
            $newId = $json[0] .
            $json[1] .
            $json[2] .
            $json[3] .
            $json[4];

            return md5($newId);
            
        }
    
    }

?>