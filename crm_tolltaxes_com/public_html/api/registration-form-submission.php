<?php
// if((isset($_GET['website'])) && ($_GET['website'] != '')){
//     $website = $_GET['website'];
// } else {
//     $website = strtoupper($_SERVER['SERVER_NAME']);
// }

// if((isset($_GET['business'])) && ($_GET['business'] != '')){
//     $type = $_GET['business'];
// } else {
//     $type = 'OTHER';
// }

// if((isset($_GET['formName'])) && ($_GET['formName'] != '')){
//     $form_name = $_GET['formName'];
// } else {
//   die();
// }

// if((isset($_GET['name'])) && ($_GET['name'] != '')){
//     $applicant_name = $_GET['name'];
// } else {
//   die();
// }

// if((isset($_GET['mobile'])) && ($_GET['mobile'] != '')){
//     $number = $_GET['mobile'];
// } else {
//   die();
// }

// if((isset($_GET['email'])) && ($_GET['email'] != '')){
//     $email = $_GET['email'];
// } else {
//   die();
// }

// if((isset($_GET['status'])) && ($_GET['status'] != '')){
//     $status = $_GET['status'];
// } else {
//   $status = 'Unpaid';
// }

// if((isset($_GET['amount'])) && ($_GET['amount'] != '')){
//     $price = $_GET['amount'];
// } else {
//   $price = 0;
// }

// if((isset($_GET['formId'])) && ($_GET['formId'] != '')){
//     $form_id = $_GET['formId'];
// } else {
//   die();
// }

// if((isset($_GET['track'])) && ($_GET['track'] != '')){
//     $track = $_GET['track'];
// } else {
//   $track = 'Unpaid';
// }

// if((isset($_GET['date'])) && ($_GET['date'] != '')){
//     $date = $_GET['date'];
// } else {
//   date_default_timezone_set('Asia/Kolkata');
//     $date = date('Y-m-d H:i:s');
// }
// require_once("../config/db.php");
// $sql = "INSERT INTO `forms` (`web`, `type`, `form_name`, `name`, `number`, `email`, `status`, `price`, `form_id`, `track_status`,`form_date`) VALUES ('$website','$type','$form_name','$applicant_name','$number','$email','$status','$price','$form_id','$track','$date')";

// if ($conn->query($sql) === TRUE) {
// echo $conn->insert_id;
// } else {
// echo false;
// }


?>