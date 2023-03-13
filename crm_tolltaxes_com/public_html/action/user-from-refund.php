<?php
if(isset($_GET['id'])){
require_once("../config/db.php");
$sql = "UPDATE `forms` SET `track_status`='Refund' WHERE  `id` ='".$_GET['id']."'";
$sql_track = "UPDATE `forms` SET `tracking_details`='Refunded' WHERE  `id` ='".$_GET['id']."'";
$conn->query($sql_track);
if ($conn->query($sql) === TRUE) {
  header("Location: ../dashboard.php?status=refund");
} else {
  echo "Error updating record: " . $conn->error;
}
}
 ?>
