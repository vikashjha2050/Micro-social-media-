<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,'webkuldb');
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>


      