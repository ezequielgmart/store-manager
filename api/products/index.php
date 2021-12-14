<?php

    require "../classes/products/products.php";

    $_products = new Products();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id != "") {
                # Have id
                $_users->getById($token,$id);
            } else {
                $_products->get($token);
                # Get all
            }
            
        } else {
            // $_users->get($token);
            # Get all
                $_products->get($token);

        }
        

    } else if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =  json_decode(file_get_contents("php://input"));
        $headers = getallheaders();
        $token = $headers["authorization"];

        $json = array(
            $data->name,
            $data->brand,
            $data->price,
            $data->description,
            $data->category,
        );

        $_products->post($token,$json);
                
    } else if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        // $data =  json_decode(file_get_contents("php://input"));
        // $headers = getallheaders();
        // $token = $headers["authorization"];
        // if ($token !="") {
        //     if (isset($_GET["id"])) {
        //         $id = $_GET["id"];
        //         if (empty($id)) {
        //             $_users->error_no_id();
        //         } else {
        //             $_users->delete($id,$token);
        //         }
                
        //     } else {
        //         $_users->error_no_id();
    
        //     }
        // } else {
        //     $_users->error_no_token();

        // }
        
        
    } else{

        echo "method not allowed";
    }
?>