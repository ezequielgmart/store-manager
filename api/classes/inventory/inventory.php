<?php
    require "../classes/users/control.php";
    require "control.php";


    
    class Inventory{
        // public function get($token,$json=""){

        //         # The objects we gonna working with 
        //         $_userControl = new UsersControl();
        //         $_productsControl = new ProductsControl();
        //         $_responses = new Responses();

        //         # validate the token we are working with 
        //         $tokenVerify = $_userControl->validateToken($token);
        //         if ($tokenVerify != 0) {


        //             # if the token is good
                    
        //             # The 1 as paramenter means the first type of get which is getAll no criteria
        //             if ($json == "") {
        //                 # if the request doesn't content any id the type of get is getAll
        //                 $result = $_productsControl->get(1);
        //                 if (!empty($result)) {
        //                     $_responses->get_ok($result);
        //                     # code...
        //                 } else {
        //                     $_responses->no_content();

        //                 }
                        
        //             } else {
        //                 $result = $_productsControl->get(2,$json);
        //                 if (!empty($result)) {
        //                     $_responses->get_ok($result);
        //                     # code...
        //                 } else {
        //                     $_responses->no_content();

        //                 }
        //             }
                    
            

        //         } else {
        //             # else token aint good
        //             $_responses->token_error();
        //         }
            
            
        // }

        public function post($token,$json,$type){
            # The objects we gonna working with 
            $_userControl = new UsersControl();
            $_inventoryControl = new InventoryControl();
            $_responses = new Responses();

            # validate the token we are working with 
            $tokenVerify = $_userControl->validateToken($token);

            if ($tokenVerify != 0) {

                if ($type == 1 ) {
                    # if the token is good
                    $result = $_inventoryControl->buy($json);

                        if ($result !=1) {
                            $_responses->server_error();
                        } else {
                            
                            $_responses->created();
            
                        }
                } else if ($type == 2){

                    $result = $_inventoryControl->sell($json);
                        if ($result !=1) {
                            $_responses->server_error();
                        } else {
                            
                            $_responses->created();
            
                        }
                } else if ($type > 2 || $type < 1){

                    $_responses->missing();

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

        public function put($token,$id,$json,$edit){
            # The objects we gonna working with 
            $_userControl = new UsersControl();
            $_productsControl = new ProductsControl();
            $_responses = new Responses();

            # validate the token we are working with 
            $tokenVerify = $_userControl->validateToken($token);

            if ($tokenVerify != 0) {


                $result = $_productsControl->edit($id,$json,$edit);

                if ($result !=1) {
                    $_responses->server_error();
                } else {
                    
                    $_responses->update_ok();

                }

            } else {
                # else token aint good
                $_responses->token_error();
            }
            
        }
        
    
    }

?>