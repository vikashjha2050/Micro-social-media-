<?php
   include('session.php');

   $sqlquery2 = "SELECT * FROM user where email= '$session_email'";
   $sqlresult2 = mysqli_query($conn,$sqlquery2);
    $array2=array();
    while($row = mysqli_fetch_assoc($sqlresult2)) {
            $array2[]=$row;   } 
?>

<html>
   <head>
   	<link rel="stylesheet" type="text/css" href="homec.css">
      <title>Home </title>
<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var val1='<?php echo $session_email ?>';
var url ="retrievemygroup.php?useremail="+val1;
var asynchronous=true;
ajax.open(method,url,asynchronous);
ajax.send();
ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var x=document.getElementsByClassName("column left");
            for(i=0;i<myObj.length;i++){
            var para = document.createElement("a");
            para.innerHTML = myObj[i].groupname;
            para.setAttribute("href", "group.php?groupid="+myObj[i].groupid); 
            x[0].appendChild(para);}
          } }; 
</script>
<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var url ="retrieveallgroup.php";
var asynchronous=true;
ajax.open(method,url,asynchronous);
ajax.send();
ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var x=document.getElementsByClassName("column right");
            for(i=0;i<myObj.length;i++){
            var para = document.createElement("a");
            para.innerHTML = myObj[i].groupname;
            para.setAttribute("href", "group.php?groupid="+myObj[i].groupid); 
            x[0].appendChild(para);}
          } }; 
</script>

<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var url ="retrievequestions.php";
var asynchronous=true;
ajax.open(method,url,asynchronous);
ajax.send();
ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var x=document.getElementsByClassName("column center");
            for(i=myObj.length-1;i>=0;i--){
            
            var divcon=document.createElement("div");
            divcon.style.backgroundColor="#ccdcff";

            var para1 = document.createElement("p");
            var text1=document.createElement("a");
            text1.innerHTML= myObj[i].username;
            text1.setAttribute("href", "profile.php?useremail="+myObj[i].uemail+"&username="+myObj[i].username); 
            para1.appendChild(text1);
            
            var para2 = document.createElement("p");
            var text2=document.createElement("a");
            text2.innerHTML= myObj[i].groupname;
            text2.setAttribute("href", "group.php?groupid="+myObj[i].group_id); 
            para2.appendChild(text2);
            
            var para3 = document.createElement("p");
            para3.innerHTML = myObj[i].qcontent;
            
            x[0].appendChild(divcon);
			      divcon.appendChild(para1);
            divcon.appendChild(para2);
            divcon.appendChild(para3);}
          } }; 
</script>

<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var asynchronous=true;
function creategroupfun(){
	var groupname = prompt("Please enter group name:");
  var grouppurpose = prompt("Description of group:");
	if (groupname == "" || groupname==null) {
        alert("Group name should not be null");} 
        else {
var url ="creategroup.php?groupname1="+groupname+'&grouppurpose1='+grouppurpose;
ajax.open(method,url,asynchronous);
ajax.send();
ajax.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var x=document.getElementsByClassName("column right");
            for(i=0;i<myObj.length;i++){
            var para = document.createElement("a");
            para.innerHTML = myObj[i].groupname;
            para.setAttribute("href", "group.php?groupid="+myObj[i].groupid); 
            x[0].appendChild(para);}
          } }; 
  alert( groupname + "  "+"created successfully");
        }        
}     
</script>

  </head>   
  <body>
  <div class="container">
	    <div class="heading">
			<p><a href = "home.php">Group chat</a></p> 
          	<p><a href = "logout.php">Sign out</a></p>
        </div>
    <div class="row">
	  <div class="column left" >
		              <a href = "profile.php?useremail=<?php echo $session_email;?>&username=<?php echo $session_user;?>"><?php echo $session_user;?></a>
					  <a style="background-color:grey;">My groups</a>
					  
	  </div>
	  <div class="column center" >
			   
	  </div>
		  <div class="column right" >
        <a style="background-color:grey;" >All groups</a>
           <input type="submit" onclick="creategroupfun()" value="Create Group">

		   </div>
    </div>        
</div>
</body>
   
</html>