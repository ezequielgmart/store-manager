<?php

    require "../classes/users/users.php";

    $_users = new Users();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $_users->get();

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
    } else{

        echo "method not allowed";
    }
?>