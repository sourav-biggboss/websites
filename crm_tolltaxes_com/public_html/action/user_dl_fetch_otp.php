<?php
if(isset($_GET['id'])){
require_once("../config/db.php");
$sql = "SELECT * FROM `forms` WHERE `id` ='".$_GET['id']."'";
$result = mysqli_query($conn,$sql);
if (mysqli_num_rows($result) != 1) { die ('<script>console.log("row not founnd !");</script>'); }
$row= mysqli_fetch_array($result);
echo "OTP is : ".$row['user_otp'];
}
 ?>
