<?php
   include('session.php');
   $useremail1 = $_GET['useremail'];

   $sqlquery = "SELECT * FROM grouptable where groupid in(SELECT group_id FROM group_user where user_email='$useremail1')";
   $sqlresult = mysqli_query($conn,$sqlquery);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
?>