<?php
include_once 'config/bd.php';
include_once 'config/cors.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents('php://input'));
    
    $fname = $data->$firstname;
    $lname = $data->$lastname;
    $uname = $data->username;
    $pass = $data->password;

    $hashed = password_hash($pass, PASSWORD_DEFAULT);


    $sql= $conn->query("INSERT INTO users(firstname, lastname, username, password) VALUES ('$fname' ,'$lname','$uname','$hashed')");
    if($sql){
        http_response_code(201);
        echo json_decode(array('message' => 'User created'));
    }else{
        http_response_code(500);
        echo json_decode(array('message' => 'Internal Server error'));
    }
}else{
    http_response_code(404);
}