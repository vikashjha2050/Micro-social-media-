<?php
include("connection.php");
session_start();

$email = mysqli_real_escape_string($conn, $_POST['email1']);
$pass = mysqli_real_escape_string($conn, $_POST['psw1']);
$pass1=md5($pass);

$sql = "SELECT username FROM user WHERE email = '$email' and password = '$pass1'";

$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $_SESSION['login_email'] = $email;
	header("location:/webkul/home.php");
} else
{
	header("location:/webkul/logsign.php"); 
    
}
$conn->close();

?>