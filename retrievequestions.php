<?php
   include('session.php');
   $sqlquery= "select group_user.group_id,question.qcontent,question.uemail,grouptable.groupname,user.username from group_user INNER JOIN question on question.groupid=group_user.group_id inner join grouptable on grouptable.groupid=group_user.group_id inner join user on question.uemail=user.email where group_user.user_email='$session_email'";
   $sqlresult = mysqli_query($conn,$sqlquery);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
?>