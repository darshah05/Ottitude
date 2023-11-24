<?php

require './dbcon.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Method: *");


function retrieve($params){
    global $conn;
    $query = "SELECT * FROM favourites WHERE user_id=$params";
    $result = mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($data); // Output the data as JSON
        }
    }
}

function update($params){
    $task = $params['task'];
    $user_id=$params['user_id'];
    $movie_id=$params['movie_id'];
    global $conn;
    if ($task=='create') {
        # code...
        $query = "INSERT INTO favourites (user_id,movie_id) VALUES ($user_id,$movie_id)";
    } else {
        # code...
        $query = "DELETE FROM favourites WHERE user_id=$user_id AND movie_id=$movie_id";
    }
    
    mysqli_query($conn,$query);
}

$request_method = $_SERVER['REQUEST_METHOD']; 

if($request_method==='GET'){
    $input = $_GET['id'];
    retrieve($input);
}elseif ($request_method==="POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    update($input);
}

?>
