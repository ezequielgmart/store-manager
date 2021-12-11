
<?php

    class Db{
        
            private $db='';
            private $host='';
            private $user='';
            private $pass='';
            private $conn='';

            private $table = "userTokens";
    
             function __construct() {
                 $fileData = $this->getDbInfo();
               
                 foreach ($fileData as $key => $value) {
                    $this->db = $value["db"];
                    $this->host = $value["host"];
                    $this->user = $value["user"];
                    $this->pass = $value["password"];
    
                
                }
    
                $this->conn = new mysqli($this->host, $this->user,$this->pass, $this->db);
    
                
                if ($this->conn->connect_errno) {
                    echo "conection failed";
                    die();
                }
            }
    
            public function getConn(){
            
                

            }
            private function getDbInfo(){
                $dir = dirname(__FILE__);
                $file = file_get_contents($dir .'/config.json');
                return $data = json_decode($file, true);
    
    
            }
    
            public function nonQuery($query){
                $result = $this->conn->query($query);
                // $result = $this->conn->query($query);
                // return $result;
                if ($this->conn->affected_rows != 1) {
                    return 0;
                } else {
                    return 1;
                }
                
                // return $this->conn->affected_rows;
            }
    
            public function nonQueryId($query){
                $result = $this->conn->query($query);
                $rows =  $this->conn->affected_rows;
                if ($rows != 0) {
                    return $rows;
                } else {
                    return 0;
                }
                
            }
    
            
            public function getData($query){
                $result = $this->conn->query($query);
                $array = array();
                foreach ($result as $key ) {
                    $array[] = $key;
    
                }
                return $array;
            }
    

            public function getUserIdByToken($token){
                $query = "SELECT userId,status FROM " . $this->table ." WHERE
                tokenId ='$token'";
                $result = $this->getData($query);
                if (empty($result)) {
                    # if the token doesnt exists
                    return 0;
                } else {
                    $array = array();
                    foreach ($result as $key => $value) {
                        $array["userId"]=$value["userId"];
                        $array["status"]=$value["status"];
                    }
                    if ($array["status"] == 1) {
                        # if the token is activate and exists
                        return $array;
                    } else if ($array["status"] = 0){
                        # if the token exists but is disabled
                      return 0;
                    }
                    
                }
                
            }


            public function newToken($userId){
                
                $today = date("Y-m-d");
                $tokenId = $this->generateTokenId($today);

                $query = "INSERT INTO " . $this->table ."(
                tokenId,
                userId,
                date,
                status) 
                VALUES (
                '".$tokenId."',
                '".$userId."',
                '".$today."',
                '1')";

               $result = $this->nonQuery($query);

               if ($result) {
                    return $tokenId;
                   # code...
               } else {
                   return 0;
               }
               
               
            }
    
    
            private function generateTokenId($date){
           
                    $firstNumber = rand(1,1000);
                    $secondNumber = rand(1,10000);
                    $thirdNumber = rand(1,20);
                    $ran = $firstNumber+$secondNumber+$thirdNumber;
        
                    return md5($ran . " " . $date);
            }

            public function disableToken($token){
                /**
                 * UPDATE `usertokens` SET `status` = '1' WHERE `usertokens`.`tokenId` = '106741fe0b9e50f56e0774a031de8ba9';
                 */
                $query = "UPDATE ". $this->table ." SET status=0 where tokenId='".$token."'";

                $result = $this->nonQueryId($query);

                echo $result;
            }
            public function json($json){
                echo json_encode($json);
            }
          
        }


?>