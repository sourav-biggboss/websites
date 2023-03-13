<?php
function crm_otp($otp,$form_id){
  $web= "TOLLTAXES.COM";
  require("crm_db_conn.php");
  // to crm db
  $connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }

  $sql = "UPDATE `forms` SET `user_otp`='$otp' WHERE `web` = '$web' AND `id`= '$form_id'";

  if ($connect->query($sql) === TRUE) {
    return true;
  } else {
    return false;
  }
}
?>
