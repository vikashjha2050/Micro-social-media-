<?php
include("session.php");

if(isset($_FILES['image'])){
      $file_name = $_FILES['image']['name'];
      $target_file="images/".basename($file_name);
      $file_tmp =$_FILES['image']['tmp_name'];
      move_uploaded_file($file_tmp,$target_file);
      
      $sqlquery1 = "INSERT INTO phototable (pic, useremail) VALUES ( '$target_file' ,'$session_email')";
      $res1=mysqli_query($conn,$sqlquery1);
      
      $sqlquery = "SELECT pic FROM phototable where useremail= '$session_email'";
      $sqlresult = mysqli_query($conn,$sqlquery);
      $array1=array();
      while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 

      echo json_encode($array1);

   }

?>