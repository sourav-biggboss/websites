<?php
require('config/db.php');
$sql = "SELECT * FROM `all_mail`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql_en = "UPDATE `all_mail` SET `msg`='".urldecode($row['msg'])."' WHERE `id`='".$row['id']."'";
if ($conn->query($sql_en) === TRUE) {
  echo "Record updated successfully";
}
    
 }
} else {
  echo "0 results";
}

?>