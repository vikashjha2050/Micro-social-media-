<?php
   include('session.php');
   $gid1 = $_GET['groupid'];
   $sqlquery = "SELECT * FROM user where email in (SELECT user_email FROM group_user WHERE group_id = '$gid1') ";
   $sqlresult = mysqli_query($conn,$sqlquery);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
?>