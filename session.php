<?php
   include('connection.php');
   session_start();
   
   $user_check = $_SESSION['login_email'];
 
   $ses_sql = mysqli_query($conn,"select * from user where email = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $session_user = $row['username'];
   $session_email = $row['email'];


   if(!isset($_SESSION['login_email'])){
      header("location:logsign.php");
   }
?>

