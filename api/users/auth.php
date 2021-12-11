<?php
    require "../classes/users/users.php";

    $_users = new Users();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    # Verify a token already exists
    
    $headers = getallheaders();
    $token = $headers["authorization"];
    $_users->validateToken($token);


} else if($_SERVER["REQUEST_METHOD"] == "POST") {
    /** When the user send a Login request the user will receive a token if the request was successfuly */
    $data =  json_decode(file_get_contents("php://input"));
    $json = array(
        $data->email,
        $data->password
    );
            
    $_users->login($json);
       
          
} else if ($_SERVER["REQUEST_METHOD"] == "PUT"){
    # change the token's status
  
    $headers = getallheaders();
    $token = $headers["authorization"];
    $_users->changeTokenStatus($token);
}
?>