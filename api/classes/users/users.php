<?php
    require ("control.php");
    class Users{
        private $table = "users";
        private $subTable = "";

        # GET
        public function get(){

            $_response = new Responses();
            $_control = new Control();
            $body = array();
            $body = $_control->getAll($this->table);
            

            $this->json($body);
            $_response->code_200();
        }

        public function post($json){

            $_response = new Responses();
            $_control = new Control();
            array_push($json,$this->newId());

            $result = $_control->newUSer($this->table,$json);
            
            $this->json($result);
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