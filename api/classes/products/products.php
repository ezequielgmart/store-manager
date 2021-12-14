<?php
    require "../classes/users/control.php";
    require "control.php";


    
    class Products{
        public function get($token){

                # The objects we gonna working with 
                $_userControl = new UsersControl();
                $_productsControl = new ProductsControl();
                $_responses = new Responses();

                # validate the token we are working with 
                $tokenVerify = $_userControl->validateToken($token);
                if ($tokenVerify != 0) {


                    # if the token is good
                    
        
                    # The 1 as paramenter means the first type of get which is getAll no criteria
                    $result = $_productsControl->get(1);
                    $_responses->get_ok($result);

                } else {
                    # else token aint good
                    $_responses->token_error();
                }
            
            
        }

        public function getById($token,$json){
            # The objects we gonna working with 
            $_userControl = new UsersControl();
            $_productsControl = new ProductsControl();
            $_responses = new Responses();

            # validate the token we are working with 
            $tokenVerify = $_userControl->validateToken($token);
            if ($tokenVerify != 0) {


                # if the token is good
            
       
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