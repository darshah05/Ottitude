<?php

require './dbcon.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");


function updateFav($params){

    global $conn;
    $username = $params['username'];
    $favs = $params['favs'];
    $query = "UPDATE users SET favourites='$favs' WHERE username='$username'";
    $result = mysqli_query($conn,$query);
    
}

$request_method = $_SERVER['REQUEST_METHOD'];

if($request_method==='PUT'){
    $input = json_decode(file_get_contents("php://input"),true);
    updateFav($input);
}

?>