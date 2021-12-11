
<?php
/** This module will be dealing with the model / DB , the users.php it's a kind of interface between the frontend and the  api*/

/*
    here imma code the all methods to deal with the model, in users.php ill be coding the methods releated with the manipulation of JSON 
    and the input / output the information

    and also, the users.php will be dealing with the HTTP request from the Frontend / app / etc. Here we gonna be dealing with the 
    MODEL only. 

*/


require ("../classes/config/db.php");
require ("../classes/config/responses.php");
require ("sql.querys.php");
class Control extends Db{
    
    public $userFields = array(
        "userId",
        "email",
        "name",
        "password"
    ); 

    # verify if a token exists or not and also his status
    public function validateToken($json){

        $_responses = new Responses();

        $verify = $this->verifyToken($json);
        
        return $verify;
        

    }
   
    # Disabled a existing token
    public function disableToken($json){
        $_responses = new Responses();

        $result = $this->changeTokenStatus($json);
        if ($result > 0) {
            $_responses->tokenStatusChanged();
        } else {
           $_responses->token_error();
        }
        
    }
    # Get all users
    public function getAll($table){
    
        $_query = new Querys();
        $query = $_query->selectAll($table);
        $result = parent::getData($query);

        return $result;

    }

    # Get by Id
    public function getById($table,$json){     
        $_query = new Querys();
        $query = $_query->selectById($table,$json);
        $result = parent::getData($query);

        return $result;


    }

    # POST 
    public function newUser($table,$json){
        $_query = new Querys();
        $query = $_query->insert($table,$json);
        $result = parent::nonQuery($query);

        return $result;
    }

    # Login users with auth
    public function login($table,$json){
        $_responses = new Responses();
        
        $_query = new Querys();

        $query = $_query->login($table,$json[0]);
      
        $result = parent::getData($query);

        if (empty($result)) {
            $_responses->login_error();
           
        } else {
          
            $array = array();
            foreach ($result as $key => $value) {
                $array["email"] = $value["email"];
                $array["password"] = $value["password"];
                $array["userId"] = $value["userId"];
            }
    
            if(password_verify($json[1],$array["password"])){
                
                $verifyToken = $this->newToken($array["userId"]);
            
              
                
                if ($verifyToken !=0) {
                    $_responses->login_ok($verifyToken);
                } else{
                    $_responses->login_error();
                } 
                
            }else{
                $_responses->login_error();
            }
          
        }
        
        
       

        
        
    }
    public function deleteUser($table,$json){
        $_query = new Querys();
        $query = $_query->deleteUser($table,$json);
        $result = parent::nonQuery($query);

        return $result;
    }


    # TOKEN METHODS
    // New token with each successful login
    public function newToken($userId){
        $result = parent::newToken($userId);
        return $result;
    }

    # Check a existing token
    public function verifyToken($token){
        $result = parent::getUserIdByToken($token);
        return $result;
    }

    # Disabled a Token
    private function changeTokenStatus($token){
        $result = parent::disableToken($token);
        return $result;
    }

}




?>