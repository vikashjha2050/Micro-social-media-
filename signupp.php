<?php
include("connection.php");

 $uname = mysqli_real_escape_string($conn, $_POST['usrname']);
 $email = mysqli_real_escape_string($conn, $_POST['Email']);
 $psw = mysqli_real_escape_string($conn, $_POST['psw']);
 $psw1= md5($psw);
 $bday=  mysqli_real_escape_string($conn, $_POST["bday"]);
 $gender=  mysqli_real_escape_string($conn,$_POST["gender"]);

$sqlquery = "INSERT INTO user (username, email,password,dob,gender)
VALUES ( '$uname','$email','$psw1','$bday','$gender')";

if ($conn->query($sqlquery) === TRUE) {
    echo "You have registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>