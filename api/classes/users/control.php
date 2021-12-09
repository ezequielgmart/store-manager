
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
    
    public $fields = array(
        "userId",
        "email",
        "name",
        "password"
    ); 

    # GET
   
    public function getAll($table){
    
        $_query = new Querys();
        $query = $_query->selectAll($table);
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
}




?>