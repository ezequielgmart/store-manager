<?php

    class Responses{

        public function code_200($json=""){

            http_response_code(200);

            if ($json != "") {
                echo json_encode($json);
                $this->define_response_content(200,"Successfuly request");
            } else {
                echo json_encode("OK");
                $this->define_response_content(200,"Successfuly request");

            }
            


        }

        private function define_response_content($code,$msg){
           $body = array();
            
           $body["code"] = $code;
           $body["msg"] = $msg;
        
           echo json_encode($body);

        }
    }


?>