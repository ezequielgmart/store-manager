<?php

    require "../classes/users/users.php";

    $_users = new Users();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id != "") {
                $_users->getById($token,$id);
            } else {
                $_users->get($token);
            }
            
        } else {
            $_users->get($token);

        }
        

    } else if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =  json_decode(file_get_contents("php://input"));
        $headers = getallheaders();
        $token = $headers["authorization"];
        $json = array(
            $data->email,
            $data->name,
            password_hash($data->password,PASSWORD_DEFAULT)
        );
                
            $_users->post($json,$token);   
    } else if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $data =  json_decode(file_get_contents("php://input"));
        $headers = getallheaders();
        $token = $headers["authorization"];
        if ($token !="") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (empty($id)) {
                    $_users->error_no_id();
                } else {
                    $_users->delete($id,$token);
                }
                
            } else {
                $_users->error_no_id();
    
            }
        } else {
            $_users->error_no_token();

        }
        
        
    } else{

        echo "method not allowed";
    }
?>
