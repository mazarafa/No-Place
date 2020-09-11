<?php
#<!-- This is protected route. Accessed by onlu logged in users -->
include_once 'config/bd.php';
include_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;

include_once 'config/cors.php';

// get request headers
$authHeader = getallheaders();
if(isset($authHeader['Authorzation']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $token = $authHeader['Authorization'];
    $token = explore(" ", $token)[1];

    try{
        
        $key = "YOU_SECRET_KEY";
        $decoded = JWT::decode($token, $key, array('HS256'));
        http_response_code(200);
        echo json_encode($decoded);

    }catch(Exception $e){
        http_response_code(401);
        echo json_encode(array('message'=>'Plase authenticate'));
    }
}else{
    http_response_code(401);
    echo json_encode(array('message'=>'Plase authenticate'));
}