<?php

// $server = "localhost";
// $user = "root";  
// $pass = "";
// $db = "projecttwo2";

// $conn = mysqli_connect($server, $user, $pass, $db);
$conn = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME'),
    getenv('DB_PORT')
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>