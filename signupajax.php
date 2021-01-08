<?php

$inp=file_get_contents('php://input');
$dataform=json_decode($inp);
if($dataform){
 

// checking any filled is empty
 if(empty($dataform->name)){die('{"error":"true","data":"Please Enter name !"}');}
 if(empty($dataform->number)){die('{"error":"true","data":"Please Enter number !"}');}
 if(empty($dataform->password)){die('{"error":"true","data":"Please Enter Password !"}');}
 if(empty($dataform->email)){die('{"error":"true","data":"Please Enter Email !"}');}

  if(!filter_var($dataform->email,FILTER_VALIDATE_EMAIL)){die('{"error":"true","data":"Please Enter Valid Email !"}');}
if(!preg_match("/[0-9]{10}+$/",$dataform->number)){die('{"error":"true","data":"Please Enter valid number !"}');}
if(!preg_match("/^([a-zA-Z' ]+)$/",$dataform->name)){die('{"error":"true","data":"Please Enter valid name !"}');}
if(strlen($dataform->password)<7){die('{"error":"true","data":"Please Enter atleast 8 digit password !"}');}

//insert in db
// die('{"error":"false","data":"Account successfully created"}');
$conn=mysqli_connect("localhost","root","","registered");
 
$query="INSERT INTO `new` (`name`,`pass`,`number`,`email`) VALUES ('".$dataform->name."','".$dataform->password."','".$dataform->number."','".$dataform->email."')";
	if(!$conn){die('{"error":"true","data":"error db"}'); }
if(mysqli_query($conn,$query)){
	 die('{"error":false,"data":"Account successfully created"}');
	
	}else{die('{"error":"true","data":"something went wrong!"}'); }
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
<input id="name" type="text" placeholder="fullname">
<input id="email" type="email" placeholder="email">
<input id="number" type="number" placeholder="number">
<input id="password" type="password" placeholder="password">

<button id="submit">submit</button>

<script>
$("document").ready(function(){
$('#submit').click(function(){

	 $("button").text("please wait..");
	
var formdata={
name: $("#name").val(),
email: $("#email").val(),
number:$("#number").val(),
password:$("#password").val()
};

var formjson = JSON.stringify(formdata);

$.ajax("<?php echo $_SERVER['PHP_SELF']; ?>",{
type:"POST",
dataType:"json",
data:formjson,
success: function(data,stateTxt){
if(stateTxt=="success"){
	if(data.error=="true"){
		 $("#noticebar").addClass("danger");
	}else{
		 $("#noticebar").addClass("success");
		}
		 	$("#noticebar").text(data.data);
		
	}
},
error: function(){


},
complete:function(){$("button").text("submit");}
});

});

});

 
</script>

</body>




</html>