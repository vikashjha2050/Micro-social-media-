<?php
include("session.php");

if(isset($_FILES['image'])){
  
      $file_name = $_FILES['image']['name'];
      $target_file="images/".basename($file_name);
      $file_tmp =$_FILES['image']['tmp_name'];
      move_uploaded_file($file_tmp,$target_file);
      
      $sql1="UPDATE user SET profile_pic = '".$target_file."' where email= '$session_email'";
      $res1=mysqli_query($conn,$sql1);
      
      $sqlquery = "SELECT profile_pic FROM user where email= '$session_email'";
      $sqlresult = mysqli_query($conn,$sqlquery);
      $array1=array();
      while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 

      echo json_encode($array1);

   }

?>