<?php

    require "../classes/inventory/inventory.php";

    $_inventory = new Inventory();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $headers = getallheaders();
        $token = $headers["authorization"];

        if (isset($_GET["id"])) {
            // transactionId
            $criteria = "transactionId";
            $json = $_GET["id"];
          
            $_inventory->get($token,$criteria,$json);
        } else if(isset($_GET["date"])){
            // date
            $criteria = "date";
            $json = $_GET["date"];

            $_inventory->get($token,$criteria,$json);
        } else if(isset($_GET["product"])){
            $criteria = "productId";
           $json = $_GET["product"];

           $_inventory->get($token,$criteria,$json);
        } else if(isset($_GET["costumer"])){
            #costumerId
            $criteria = "costumerId";
            $json = $_GET["costumer"];

            $_inventory->get($token,$criteria,$json);
        } else {
        //    echo "No criteria";
        
            $_inventory->get($token);

        }
        

    } else if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =  json_decode(file_get_contents("php://input"));
        $headers = getallheaders();
        $token = $headers["authorization"];
        if (isset($_GET["transaction"])) {
            $transaction = $_GET["transaction"];

            if ($transaction == 1) {
                 # only The users  are able to make buy request
                 # BUY 
                $json = array(
                        $data->id,
                        $data->amount,
                        $data->value,
                        $data->productId                    
                    );

                    array_unshift($json,date("d-m-y h:i:s"));

                    array_push($json,$transaction);

                    /**
                     * $json array gonna be:
                     * 1. Date
                     * 2. userId
                     * 3. entryAmount
                     * 4. entryValue
                     * 5. productId
                     * 6. transactionType 
                     */

                    $_inventory->post($token,$json,1);

            } else if ($transaction == 2){
                # only The costumer  are able to make sell request
                # SELL 
                $json = array(
                    $data->id,
                    $data->amount,
                    $data->value,
                    $data->productId                    
                );

                array_unshift($json,date("d-m-y h:i:s"));

                array_push($json,$transaction);

                /**
                 * $json array gonna be:
                 * 1. Date
                 * 2. costumerID
                 * 3. outAmount
                 * 4. outValue
                 * 5. productId
                 * 6. transactionType 
                 */

                $_inventory->post($token,$json,2);

            } else if ($transaction > 2 || $transaction < 1){
                echo json_encode("Invalid transaction.");
                http_response_code(400);
            }
        } else {
            # code...
            echo json_encode("Define the type of transaction.");
            http_response_code(400);
        }
        // $json = array(
        //     $data->constumerId,
        //     $data->brand,
        //     $data->price,
        //     $data->description,
        //     $data->category,
        // );

        // $_products->post($token,$json);
                
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
