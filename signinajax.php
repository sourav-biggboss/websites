<?php


// checking any filled is empty
 
 if(isset($_POST['email'])&&isset($_POST['password'])){
 
//insert in db
//if($_POST['email']=="email"&&$_POST['password']=="password"){die("success");}else{die('incorrect password or email');}
$conn=mysqli_connect("localhost","root","","registered");
 
$query="SELECT `pass`,`email` FROM `new` WHERE `pass` = '".$_POST['password']."' AND `email` = '".$_POST['email']."'";
	if(!$conn){die('error db'); }
	$dbdata= mysqli_query($conn,$query);
if(mysqli_num_rows($dbdata)==1){
	 die('success');
	
	}else{die('incorrect password or email!'); }
//
die();
}
?>
<html>
<head>
<link rel="stylesheet" href="css.css">
<link rel="icon" href="gf.png">
<meta name="viewport" contant="width=device-width,initail-scale=1.0">
<script src="jquery/jquery.js" ></script>
<style>.danger{background-color: red; color:#fff;} .success{background-color: green; color:#fff;} </style>
</head>
<body>
<div id="noticebar"></div>
<input id="email" type="email" placeholder="email" required>
<input id="password" type="password" placeholder="password" required>

<button id="submit">submit</button>

<script>
$("document").ready(function(){
	
$('#submit').click(function(){

	 var emailf =	$("#email").val();
var passwordf =	$("#password").val();
	
	var em= document.getElementById('email');
	var ps= document.getElementById('password');
	if(em.checkValidity()&&ps.checkValidity()){
	
	
	 $("button").text("please wait..");

$.ajax("<?php echo $_SERVER['PHP_SELF']; ?>",{
type:"POST",
dataType:"text",
data:{email:emailf,password:passwordf},
success: function(data,stateTxt){
if(stateTxt=="success"){ 
	
		 if(data=="success"){
			 $("#noticebar").addClass("success");
			 $("#noticebar").text(data);
			}else{
				$("#noticebar").addClass("danger");
			 $("#noticebar").text(data);
			}
		
	}
},
error: function(){


},
complete:function(){$("button").text("submit");}
});

}else{ $("#noticebar").addClass("danger");$("#noticebar").text("please type correct email or password"); }



});



});

 
</script>

</body>




</html>