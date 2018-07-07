<?php
   include('session.php');
   $gid1 = $_GET['groupid'];
   $sqlquery1= "select question.qcontent,question.uemail,user.username from user INNER JOIN question on question.uemail=user.email where question.groupid=$gid1 ";
   $sqlresult1 = mysqli_query($conn,$sqlquery1);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult1)) {
            $array1[]=$row; } 
   
   $sqlquery2= "select grouptable.groupname, grouptable.grouppurpose from grouptable where grouptable.groupid = $gid1 ";
   $sqlresult2 = mysqli_query($conn,$sqlquery2);
   
   $array2=array();
   while($row = mysqli_fetch_assoc($sqlresult2)) {
            $array2[]=$row;   } 
   
   echo(json_encode(array($array1,$array2)));
?>