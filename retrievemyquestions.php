<?php
   include('session.php');
   $useremail = $_GET['useremail'];
   $sqlquery= "select question.groupid,question.qcontent,grouptable.groupname from question INNER JOIN grouptable on question.groupid=grouptable.groupid where question.uemail='$useremail'";
   $sqlresult = mysqli_query($conn,$sqlquery);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
?>