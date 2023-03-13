<?php
require_once("web-data.json.inc.php");
function other_web_conn($other_web_host, $other_web_user, $other_web_pass, $other_web_db_name){
  $conn = new mysqli($other_web_host, $other_web_user, $other_web_pass, $other_web_db_name);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}
?>
