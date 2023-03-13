<?php
if(isset($_POST['track_details'])){
require_once("config/db.php");
$sql = "UPDATE `forms` SET `tracking_details`='".$_POST['track_details']."' WHERE  `id` ='".$id."'";
if ($conn->query($sql) === TRUE) {
  include("views/blog-success.php");
} else {
  include("views/blog-alert.php");
}
}
 ?>
