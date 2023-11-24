<?php

require './dbcon.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Method: *");

function getMovies() {
    global $conn;

    $query = 'SELECT * FROM movies';
    $movies = mysqli_query($conn, $query);

    if ($movies) {
        if (mysqli_num_rows($movies) > 0) {
            $result = mysqli_fetch_all($movies, MYSQLI_ASSOC);

            // Iterate through the result and convert the image location to binary data
            foreach ($result as &$movie) {
                $imageLocation = $movie['location'];
                $imageData = file_get_contents($imageLocation);

                // Convert the image data to a base64-encoded string
                $base64ImageData = base64_encode($imageData);

                // Add the binary data as a new field in the movie array
                $movie['imageData'] = $base64ImageData;
            }

            return $result;
        }
    } else {
        // Handle the case where the query fails
    }
}

$request_method = $_SERVER["REQUEST_METHOD"];
if ($request_method === 'GET') {
    $movie_list = getMovies();
    echo json_encode($movie_list);
}
?>
