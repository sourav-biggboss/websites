<?php
if(isset($_POST['stage_name'])){
require_once("config/db.php");
$sql = "UPDATE `forms` SET `track_stage_id`='".mysqli_real_escape_string($conn,$_POST['stage_name'])."',`tracking_details` = '".mysqli_real_escape_string($conn,$_POST['stage_name'])."' WHERE  `id` ='".$id."'";
if ($conn->query($sql) === TRUE) {
  include("views/blog-success.php");
} else {
  include("views/blog-alert.php");
}
}
?>
