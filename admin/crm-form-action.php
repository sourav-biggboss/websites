<?php
function from_to_crm($website = null,$type,$form_name,$applicant_name = null,$number = null,$email = null,$status = null,$price,$form_id,$track = null,$date = null){
  $price = (int)$price;
  $form_id = (int)$form_id;
  require("crm_db_conn.php");
  if($website === null){
    $website = strtoupper($_SERVER['SERVER_NAME']);
  }
  if($applicant_name === null){
    $applicant_name ='null';
  }
  if($number === null){
    $number ='null';
  }
  if($email === null){
    $email ='null';
  }
  if($status === null){
    $status ='Unpaid';
  }
  if($track === null){
    $track ='Unpaid';
  }
  if($date === null){
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
  }
  // to crm db
  $connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }

  $sql = "INSERT INTO `forms` (`web`, `type`, `form_name`, `name`, `number`, `email`, `status`, `price`, `form_id`, `track_status`,`form_date`) VALUES ('$website','$type','$form_name','$applicant_name','$number','$email','$status','$price','$form_id','$track','$date')";

  if ($connect->query($sql) === TRUE) {
    return true;
  } else {
    return false;
  }
}
?>
