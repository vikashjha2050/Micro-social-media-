<?php
   include('session.php');
   $useremail=$_GET['useremail'];
   $sqlquery = "SELECT pic FROM phototable where useremail= '$useremail'";
   $sqlresult = mysqli_query($conn,$sqlquery);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
?>