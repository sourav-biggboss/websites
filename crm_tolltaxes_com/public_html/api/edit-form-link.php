<?php


if((isset($_GET['fulllink'])) && ($_GET['fulllink'] != '')){
    $editable_full_link = $_GET['fulllink'].'&token_function=BULK_DATA_CAMPN';
} 
else {
  die('error required fulllink');
}

if((isset($_GET['pannel_form_id'])) && ($_GET['pannel_form_id'] != '')){
    $pannel_form_id = $_GET['pannel_form_id'];
}
else {
  die('error required pannel_form_id');
}

if((isset($_GET['formId'])) && ($_GET['formId'] != '')){
    $form_id = $_GET['formId'];
}
else {
  die('error required formId');
}

  date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
require_once("../config/db.php");
$sql = "INSERT INTO `editable_link`(`pannel_form_id`,`full_link`, `form_id`) VALUES ('".$pannel_form_id."','".$editable_full_link."','".$form_id."')";

if ($conn->query($sql) === TRUE) {
echo $conn->insert_id;
} else {
echo false;
}


?>