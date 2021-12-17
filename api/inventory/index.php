<?php

    require "../classes/products/products.php";

    $_products = new Products();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id == "") {
                # Have id
                $_products->get($token);
            } else {
                # Get all
                
                $id = $_GET["id"];
                $_products->get($token,$id);
               
            }
            
        } else {
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
        $data =  json_decode(file_get_contents("php://input"));
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id == "") {
                # Have id
                http_response_code(402);
                echo json_encode("Id not found");
            } else {
                # Get all
                
                $id = $_GET["id"];
                $_products->delete($token,$id);
               
            }
            
        } else {
            http_response_code(402);
            echo json_encode("Id not found");

        }

        
        
        
    }else if($_SERVER["REQUEST_METHOD"] == "PUT") {
        $data =  json_decode(file_get_contents("php://input"),true);
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            if ($id == "") {
                # Have id
                http_response_code(402);
                echo json_encode("Id not found");
            } else {
                
               $id = $_GET["id"];
            
               if(isset($_GET["name"])){

                    $json = $_GET["name"];
                    $edit = 1;
                    
                    $_products->put($token,$id,$json,$edit);

                }else if(isset($_GET["brand"])){
                   
                    $json = $_GET["brand"];
                    $edit = 2;
                    $_products->put($token,$id,$json,$edit);


                }else if(isset($_GET["price"])){
                    
                    $json = $_GET["price"];
                    $edit = 3;
                    $_products->put($token,$id,$json,$edit);


                }else if(isset($_GET["description"])){
                   
                    $json = $_GET["description"];
                    $edit = 4;
                    $_products->put($token,$id,$json,$edit);


                }else if(isset($_GET["category"])){

                    $json = $_GET["category"];
                    $edit = 5;
                    $_products->put($token,$id,$json,$edit);

                }else{

                    http_response_code(402);
                    echo json_encode("Data not found. Try again");

               }
               
               
            }
            
        } else {
            http_response_code(402);
            echo json_encode("Id not found");

        }

        
        
        
    } else{

        echo "method not allowed";
    }
?>
