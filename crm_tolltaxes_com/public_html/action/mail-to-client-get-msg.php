<?php
require_once("../config/db.php");
if ((isset($_GET['web']))&&(isset($_GET['id']))) {

  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $web = mysqli_real_escape_string($conn, $_GET['web']);

  $sql = "SELECT `msg` FROM `all_mail` WHERE `id` = '$id' and `web` = '$web'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
      echo $row['msg'];
    }
  } else {
    echo 'Error!! While Sending Mail From Our System';
  }
} else {
  echo 'Error!! While Sending Mail From Our System';
}
?>
