<?php

include(".././header.php");
require("../config.php");
if (isset($_POST['save'])) {
$current_url = strtoupper($_SERVER['SERVER_NAME']);
if (empty($_POST["order_id"])) {

} 
else{
  $ch = curl_init('https://crm2.techlounge.co.in/api/test.php?orderId='.$_POST["order_id"].'&website='.$current_url.'');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec ($ch); 
  curl_close($ch);
  //echo $response;
  $array=explode(',',$response);
 //print_r($array);
}
if($_POST['order_id']==''){
    echo "<span style='color:#c11818;text-align:center;font-weight:bold;display:block;margin:15px;font-size:25px;'><i class='far fa-frown'style='font-size:30px;'></i> Incorrect Order Id / Not Found</span>";  
    echo"<div style='text-align:center;'>";
    echo'<button onclick="goBack()"class="btn btn-primary fcs-submit-button">Go Back To Previous Page</button>';
    echo "</div>";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo strtoupper($_SERVER['SERVER_NAME']);?> TRACK</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="main.css">

<style>
table, th{
  border: 1px solid black;
  border-collapse: collapse;
    background: #e4e4e4;
}
td {
  border: 1px solid black;
  border-collapse: collapse;
    background: #f6fbff;

}
th, td {
  padding: 5px;
  width: 5%;
  text-align: left;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
table{
width:100%;
}
}
</style>
<br>
<div class="container-fluid fcs-form-container" id="content" <?php if ($_POST['order_id']==''){ echo 'style="display:none;"'; } ?>>
<div class="fchd mx-auto d-block text-uppercase text-center" style="font-size:15px;width:50%">Order Id Details</div>
<table style='width:50%' class='center'>
  <tr>
    <th>Name:</th>
    <td><?php echo $array[0];?></td>
  </tr>
  <tr>
    <th>Mobile:</th>
    <td><?php echo $array[1];?></td>
  </tr>
  <tr>
    <th>Email:</th>
    <td><?php echo $array[2];?></td>
  </tr>
  <tr>
    <th>Amount:</th>
    <td><?php echo $array[3];?></td>
  </tr>
<tr>
    <th>Payment Status:</th>
    <td><?php echo $array[4];?></td>
  </tr>
<tr>
    <th>Description:</th>
    <td><?php echo $array[6];?></td>
  </tr>
</table>
</div>
<br>
<script>
function goBack() {
  window.history.back();
}
</script>
<?php  include(".././footer.php");?>
