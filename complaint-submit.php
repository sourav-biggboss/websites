<!DOCTYPE html>
<html lang="en">
<head>
<title>Complaint Submit</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="submit your complaint at any time and we will contact you soon with the solution.">
<link rel="icon" href="./assets/img/flag.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="./fontawesome/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./main.css">

<style>
.container-fluid.fcs-padding-container {
background: #ffffff !important;
}
form {
background: #eee;
padding: 15px;
height: 95% !important;
}

.fchd {
    padding: 5px;
    text-align: center !important;
    background: #343a40 !important;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 14px;
}
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
th, td {
padding: 5px;
text-align: left;
}
input[type="text"]{
border: none !important;
background: transparent;
color: #000;
}
input:focus, textarea:focus, select:focus{
outline: none;
}
</style>
</head>

<?php
require("./config.php");
if (isset($_POST['submit'])){

$order_id=$_POST['order_id'];
$que=mysqli_query($conn,"SELECT * FROM fastag_form where order_id='$order_id' ");
$row = mysqli_fetch_array($que);

$current_url = strtoupper($_SERVER['SERVER_NAME']);
$date = $row['form_created_on'];
$d = date_parse_from_format("Y-m-d", $date);
if ($d["month"] <'11') {
	$ch = curl_init('https://crm.techlounge.co.in/api/order_id.php?orderId='.$_POST["order_id"].'&website='.$current_url.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec ($ch); 
	curl_close($ch);
	$array = explode(',', $response);
}

if ($d["month"] >'10') {
	$ch = curl_init('https://crm2.techlounge.co.in/api/order_id.php?orderId='.$_POST["order_id"].'&website='.$current_url.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec ($ch); 
	curl_close($ch);
	$array = explode(',', $response);
}
?>


<body>
<?php include_once('./header.php'); ?>
<br>
<?php

if (!$row) {
echo '<h2 class="text-center"style="color:red">Order id not found</h2>';
}
else {
}
//echo $row['applicant_name'];
}
?>
<br>

<div class="container-fluid fcs-form-container" id="content" <?php if (!$row){ echo 'style="display:none;"'; } ?>>
<div class="row">

<div class="col-12 col-lg-6">
<h1 class="container-fluid fchd text-center text-uppercase" style="font-size:15px">Complaint Form</h1>
<form id="main-form" action="./complaint-submit-new.php" method="post">
<div class="form-group txt">
<label>Your order summary:</label>
</div>
<table style="width:100%">
<tr>
<th>ORDER ID:</th>
<td> <input name="order_id"type="text"class="form-control" value="<?php echo $row['order_id'];?>"readonly></td>
</tr>
<tr>
<th>APPLICANT NAME:</th>
<td> <input name="applicant_name"class="form-control"type="text" value="<?php echo $row['applicant_name'];?>"readonly></td>
</tr>
<tr>
<th>MOBILE NUMBER:</th>
<td><input name="mobile_number"class="form-control"type="text" value="<?php echo $row['mobile_number'];?>"readonly></td>
</tr>
<tr>
<th>EMAIL ID:</th>
<td><input name="email_id"class="form-control" type="text" value="<?php echo $row['email_id'];?>"readonly></td>
</tr>
<tr>
<th>TRANSACTION DATE:</th>
<td><input name="transaction_date"class="form-control" type="text"value="<?php echo $row['form_created_on'];?>"readonly></td>
</tr>
<tr>
<th>TRANSACTION AMOUNT:</th>
<td><input name="transaction_amount"class="form-control" type="text"value="<?php echo $row['total_amount'];?>"readonly></td>
</tr>
</table>
<br>  
<div class="form-group txt">
<label><span class="required">If you still have any query or complaint related to your order, please use below box to describe.</span></label><br><br>
<label>DESCRIBE YOUR COMPLAINT IN DETAILS <span class="required">(Required)</span></label>
<textarea class="form-control"rows="5"name="complaint_details" ></textarea>
</div>
<button type="submit"name="submit" class="bttn inline-btn">Submit Complaint</button>
</form>
</div>
</div>
</div>
</body>
</html>
<?php include'footer.php';?>