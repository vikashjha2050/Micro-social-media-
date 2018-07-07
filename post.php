<?php
include("session.php");

 $postcontent = $_GET['post123'];
 $gid = $_GET['groupid'];
 
$sql = "INSERT INTO question (qcontent, uemail,groupid)
VALUES ('$postcontent','$session_email','$gid')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>