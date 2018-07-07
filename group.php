<?php
   include('session.php');
   $gid = $_GET['groupid'];
?>

<html>
   <head>
    <link rel="stylesheet" type="text/css" href="homec.css">
      <title>Welcome </title>
 <script>
      var i;
      var ajax =new XMLHttpRequest();
      var method="GET";
      var url ="retrievemygroup.php?useremail="+'<?php echo $session_email;?>';
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
      var val = "<?php echo $gid ?>";
      var ajax =new XMLHttpRequest();
      var method="GET";
      var url ="retrievegroupmembername.php?groupid="+val;
      var asynchronous=true;
      ajax.open(method,url,asynchronous);
      ajax.send();
      ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                  var myObj = JSON.parse(this.responseText);
                  var x=document.getElementsByClassName("column right");
                  for(i=0;i<myObj.length;i++){
                  var para = document.createElement("a");
                  para.innerHTML = myObj[i].username;
                  para.setAttribute("href", "profile.php?useremail="+myObj[i].email+"&username="+myObj[i].username); 
                  x[0].appendChild(para);}
                }  
            };

</script>
<script>
var i;
var val = "<?php echo $gid ?>";
var ajax =new XMLHttpRequest();
var method="GET";
var url ="retrievequestionsforgroup.php?groupid="+val;
var asynchronous=true;
ajax.open(method,url,asynchronous);
ajax.send();
ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var myObj = JSON.parse(this.responseText);
            
            var y=document.getElementsByClassName("column center");
            var gname = document.createElement("h1");
            gname.innerHTML=myObj[1][0].groupname;
            y[0].appendChild(gname);
            var gpurpose = document.createElement("h4");
            gpurpose.innerHTML=myObj[1][0].grouppurpose;
            y[0].appendChild(gpurpose);
            
            var x=document.getElementsByClassName("column center");
            for(i=myObj[0].length-1;i>=0;i--){
            var divcon=document.createElement("div");
            divcon.style.backgroundColor="#ccdcff";

            var para1 = document.createElement("p");
            var text1=document.createElement("a");
            text1.innerHTML= myObj[0][i].username;
            text1.setAttribute("href", "profile.php?useremail="+myObj[0][i].uemail+"&username="+myObj[0][i].username); 
            para1.appendChild(text1);
            
            var para3 = document.createElement("p");
            para3.innerHTML = myObj[0][i].qcontent;
            
            x[0].appendChild(divcon);
            divcon.appendChild(para1);
            divcon.appendChild(para3);}
          } }; 
</script>

<script>
var ajax =new XMLHttpRequest();
var method="GET";
var asynchronous=true;
function sharefun(str){
var url ="post.php?groupid=<?php echo $gid;?>&post123="+str;
ajax.open(method,url,asynchronous);
ajax.send();
}     
</script>

<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var asynchronous=true;
function Joingroup(){
var url ="joingroup.php?groupid=<?php echo $gid;?>&session_email1=<?php echo $session_email;?>";
ajax.open(method,url,asynchronous);
ajax.send();
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
            <a style="background-color:grey;"href="#" >My groups</a>
          
             </div>

  <div class="column center" >
    <div class="postsharediv">
    <form method="POST" onsubmit="sharefun(document.getElementById('a1').value)">
           <input type="text" placeholder="Share your thoughts" id="a1" name="post123" style="width:75%" >
           <input type="submit" value="SHARE"  >
    </form>
     <input type="submit" onclick="Joingroup()" value="Join group" style="width:40%">
    </div>
      <div class="postcontentdiv">
              
      </div> 
   </div>

  <div class="column right" >
    <a style="background-color:grey;">All members</a>
  
</div>
</div>
</div>

</body>
   
</html>