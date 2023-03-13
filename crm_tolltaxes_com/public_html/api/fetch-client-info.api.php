<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $web = $_GET['website'];
} else {
    $web = strtoupper($_SERVER['SERVER_NAME']);
}

if((isset($_GET['id'])) && ($_GET['id'] != '')){
    $id = $_GET['id'];
} else {
   die();
}
require_once("../config/db.php");
$sql = "SELECT * FROM `forms` WHERE `id` = '$id' AND `web` = '$web' AND `status` = 'Unpaid'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
    $form_name = $row['form_name']; $name = $row['name']; $number = $row['number']; $email = $row['email']; $price = $row['price']; $form_id = $row['form_id'];
    //json
    echo '{"form_name":"'.$form_name.'","name":"'.$name.'","number":"'.$number.'","email":"'.$email.'","price":"'.$price.'","form_id":"'.$form_id.'"}';
  }
} else {
echo false;
}


?>