<?php
require_once("../config/db.php");
if ((isset($_GET['web']))&&(isset($_GET['id']))) {

  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $web = mysqli_real_escape_string($conn, $_GET['web']);

  $sql = "SELECT `mail_from`,`sbj` FROM `all_mail` WHERE `id` = '$id' and `web` = '$web'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
      echo '{"mail_from":"'.$row['mail_from'].'","mail_sbj":"'.$row['sbj'].'"}';
    }
  } else {
    echo '{"mail_from":"0","mail_sbj":"0","mail_msg":"0"}';
  }
} else {
  echo '{"mail_from":"0","mail_sbj":"0","mail_msg":"0"}';
}
?>
