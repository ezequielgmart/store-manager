<?php
    require "../classes/users/control.php";
    require "control.php";


    
    class Products{
        public function post($token,$json){
            $_userControl = new UsersControl();
            $_productsControl = new ProductsControl();
            $_responses = new Responses();

            $tokenVerify = $_userControl->validateToken($token);

            if ($tokenVerify != 0) {


                $newId = $this->generateProductId($json);

                array_unshift($json,$newId); 

                $result = $_productsControl->add($json);

                if ($result !=1) {
                    $_responses->product_created_error();
                } else {
                    
                    $_responses->product_created();
    
                }
       
            } else {
                $_responses->token_error();
            }

        } 

        public function generateProductId($json){
            
            $newId = $json[0] .
            $json[1] .
            $json[2] .
            $json[3] .
            $json[4];

            return md5($newId);
            
        }
    
    }

?>