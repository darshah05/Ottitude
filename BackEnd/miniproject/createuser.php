<?php

require './dbcon.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Method: *");

function createUser($input){
    global $conn;
    $username = $input['username'];
    $email = $input['email'];
    $password = $input['password'];
    $query = "INSERT INTO users (username, email, password) VALUES ( '$username', '$email', '$password')";
    $enter = mysqli_query($conn, $query);
    if ($enter) {
        echo "User created successfully!";
    } else {
        echo "Error creating user: " . mysqli_error($conn);
    }
}

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    createUser($input);
}

?>
