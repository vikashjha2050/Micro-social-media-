<?php
include("session.php");
$hometown=$_GET['hometown'];
$worksat=$_GET['worksat'];

      $sql1="UPDATE user SET hometown = '$hometown', worksat='$worksat' where email= '$session_email'";
      if(!mysqli_query($conn,$sql1))
      echo("Error description: " . mysqli_error($conn));
      
      $sql1 = "SELECT hometown,worksat FROM user where email= '$session_email'";
      if(!mysqli_query($conn,$sql1)){
      echo("Error description: " . mysqli_error($conn));}
      $sqlresult = mysqli_query($conn,$sql1);
      $array1=array();
      while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 

      echo json_encode($array1);
   
?>