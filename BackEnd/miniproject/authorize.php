<?php

require './dbcon.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Method: *");


function authorize($params){

    global $conn;
    $query = "SELECT * FROM users WHERE email='$params'";
    $result = mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            $user = mysqli_fetch_assoc($result);
            echo json_encode($user); // Output the user data as JSON
        }
    }
}

$request_method = $_SERVER['REQUEST_METHOD']; 

if($request_method==='GET'){
    $input = $_GET['email'];
    authorize($input);
}

?>
