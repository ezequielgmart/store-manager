<?php

    require "../classes/users/users.php";

    $_users = new Users();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $_users->get();

    } else if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =  json_decode(file_get_contents("php://input"));
        $json = array(
            $data->email,
            $data->name,
            md5($data->password)
        );
                
            $_users->post($json);   
    } else{

        echo "method not allowed";
    }
?>