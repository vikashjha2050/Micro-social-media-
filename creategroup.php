<?php
include("connection.php");

 $groupname = $_GET['groupname1'];
 $grouppurpose = $_GET['grouppurpose1'];
 
$sqlquery1 = "INSERT INTO grouptable (groupname,grouppurpose)
VALUES ('$groupname','$grouppurpose')";
  mysqli_query($conn,$sqlquery1);


 $sqlquery2 = "SELECT * FROM grouptable where groupid=(select max(groupid) from grouptable)" ;
 $sqlresult2 = mysqli_query($conn,$sqlquery2);
   
   $array1=array();
   while($row = mysqli_fetch_assoc($sqlresult2)) {
            $array1[]=$row;   } 
   
   echo(json_encode($array1));
$conn->close();
?>