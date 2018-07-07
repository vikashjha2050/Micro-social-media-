<?php
   include('session.php');
   $useremail = $_GET['useremail'];
   $username = $_GET['username'];
   $sqlquery = " SELECT profile_pic FROM user where email='$useremail' ";
   $sqlresult = mysqli_query($conn,$sqlquery); 
   $rows = array();
   while($r = mysqli_fetch_assoc($sqlresult)) {
    $rows[] = $r;
   }

   $sqlquery2 = "SELECT hometown,worksat FROM user where email= '$useremail'";
   $sqlresult2 = mysqli_query($conn,$sqlquery2);
    $array2=array();
    while($row = mysqli_fetch_assoc($sqlresult2)) {
            $array2[]=$row;   } 
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="homec.css">
<title>Home </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
var i;
var ajax =new XMLHttpRequest();
var method="GET";
var url ="retrievemygroup.php?useremail="+'<?php echo $useremail;?>';
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
var url ="retrievemyquestions.php?useremail="+'<?php echo $useremail ?>';
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

            var para2 = document.createElement("p");
            var text2=document.createElement("a");
            text2.innerHTML= myObj[i].groupname;
            text2.setAttribute("href", "group.php?groupid="+myObj[i].groupid); 
            para2.appendChild(text2);
            var para3 = document.createElement("p");
            para3.innerHTML = myObj[i].qcontent;
            
            x[0].appendChild(divcon);
            divcon.appendChild(para2);
            divcon.appendChild(para3);}
          } }; 
</script>

<script type="text/javascript">
  $(document).ready(function (e) {
    $('#a1').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            dataType: "JSON",
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data[0].profile_pic);
                $('#pp').attr("src",data[0].profile_pic);
               
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });

    }));
});
</script>

<script type="text/javascript">
  $(document).ready(function (e) {
     $("#updateinfo").click(function(){
      var hometown = prompt("Enter your Hometown");
      var worksat = prompt("Where do you work");
        $.post("getuserdata.php?hometown="+hometown+"&worksat="+worksat,
        function(data,status){
        console.log(data);
        var obj = jQuery.parseJSON(data);
        $("#ht").html(obj[0].hometown);
        $("#wa").html(obj[0].worksat);
        });
    });
});
</script>

<script type="text/javascript">
  $(document).ready(function (e) {
    $('#a2').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url:  $(this).attr('action') ,
            data: formData,
            dataType: "JSON",
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data[0].pic);
                var a= $('<img></img>').attr({"src":data[data.length-1].pic,'width':250});
                $('#a2').after(a);               
            },
            error: function(data){
                console.log("error1");
                console.log(data);
            }
        });

    }));
});
</script>

<script type="text/javascript">
  var i;
  $(document).ready(function () {
        $.ajax({
            type:'POST',
            url:  'getimages.php?useremail='+'<?php echo $useremail ?>' ,
            dataType: "JSON",
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data[0].pic);
                for(i=data.length-1;i>=0;i--){
                var a= $('<img></img>').attr({"src":data[i].pic,'width':255});
                $('#a2').after(a);}               
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    });

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
            <a href = "profile.php?useremail=<?php echo $useremail;?>&username=<?php echo $username;?>"> <?php echo $username;?> </a>
            <a style="background-color:grey;">My groups</a>
            
    </div>
    <div class="column center" >
         
    </div>
      
      <div class="column right" >
        <a style="background-color:grey;" >Personal infromation</a>
        
        <form method="POST" action="uploadpic.php" id="a1" enctype="multipart/form-data">
        <input type="file" name="image" >
        <input type="submit" value="Submit">
        </form>
        
        <img src="<?php echo $rows[0]['profile_pic']; ?>" alt="profile pic" width=255px id="pp">
        
        <a style="background-color:#d9d9d9;" >Home town : </a>
        <a id="ht"><?php echo $array2[0]['hometown']; ?></a>
        <a style="background-color:#d9d9d9;">Works at :</a>
        <a id="wa"> <?php echo $array2[0]['worksat']; ?> </a>
        <input type="submit" value="Update info" id="updateinfo">
        
        <a style="background-color:grey;" >Images</a>
        <form method="POST" action="uploadpic1.php" id="a2" enctype="multipart/form-data">
        <input type="file" name="image" >
        <input type="submit" value="Submit">
        </form>

      </div>
    <script type="text/javascript">
    var e1='<?php echo $useremail ?>';
    var e2 = '<?php echo $session_email ?>';
if(e1 != e2)
  {
var div1 = document.getElementById('a1');
div1.style.display='none';
var div1 = document.getElementById('updateinfo');
div1.style.display='none';
var div1 = document.getElementById('a2');
div1.style.display='none';

  }  

</script>

    </div>        
</div>
</body>
   
</html>