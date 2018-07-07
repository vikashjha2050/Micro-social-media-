

<?php
include("connection.php");

 $gid = $_GET['groupid'];
 $session_email2=$_GET['session_email1'];
 
$sql = "INSERT INTO group_user (group_id,user_email)
VALUES ('$gid','$session_email2')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

