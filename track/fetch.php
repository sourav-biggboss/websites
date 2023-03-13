<!DOCTYPE html>
<html>
<head>
<title>TRACK STATUS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../style.css">

<style>
form{
height:82%;
}
</style>
<style>
.error {color: #FF0000;}
</style>
<?php  include(".././header.php");?>
<br>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="fchd text-uppercase text-center" style="font-size:15px">Track Your Order Status</div>

<form action="submit-order.php" method="post"name="complaint" onsubmit="return checkform()">
<label class="txt">Enter your order id to track your order summary</label>
<input type="text" name="order_id" class="form-control"><span class="error"><p id="name_error"></p></span>
<input type="submit" name="save" class="btn btn-primary fcs-submit-button" value="TRACK ORDER">
</form>
</div>
</div>
</div>
<script> 
    function checkform() { 
        var name = document.forms["complaint"]["order_id"];         
        if (name.value == "") { 
            nameError = "Please enter your order id";
            document.getElementById("name_error").innerHTML = nameError;
            name.focus(); 
            return false; 
        }   
        return true; 
    } 
</script> 
<br>
<?php  include(".././footer.php");?>
