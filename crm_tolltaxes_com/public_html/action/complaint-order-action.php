<?php
if(isset($_POST['complaint_msg'])){
require_once("config/db.php");
   $sql = "INSERT INTO `message` (`mobile`, `message`, `type`, `route`) VALUES ('".$user_number."','".$_POST['complaint_msg']."','complaint','0')";
   header('Location : view-form.php?web='.$web.'&id='.$id);
if ($conn->query($sql) === TRUE) {
  include("views/blog-success.php");
} else {
  include("views/blog-alert.php");
}
}
 ?>
