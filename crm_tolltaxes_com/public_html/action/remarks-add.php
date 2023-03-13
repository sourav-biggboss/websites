<?php
if(isset($_POST['remarks_details'])){
require_once("config/db.php");
$sql = "UPDATE `forms` SET `remarks`='".mysqli_real_escape_string($conn,$_POST['remarks_details'])."' WHERE  `id` ='".$id."'";
if ($conn->query($sql) === TRUE) {
  include("views/blog-success.php");
} else {
  include("views/blog-alert.php");
}
}
 ?>
