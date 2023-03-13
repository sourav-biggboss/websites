<?php
function form_to_paid($form_id){
  require("crm_db_conn.php");
  $web= "TOLLTAXES.COM";
  // to crm db
  $connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }

  $sql = "UPDATE `forms` SET `status`='Paid',`track_status` = 'Paid' WHERE `web` = '$web' AND `form_id`= $form_id";

  if ($connect->query($sql) === TRUE) {
    return true;
  } else {
    return false;
  }
}
?>
