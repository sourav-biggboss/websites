<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $website = $_GET['website'];
} else {
    $website = strtoupper($_SERVER['SERVER_NAME']);
}

if((isset($_GET['type'])) && ($_GET['type'] != '')){
    $type = $_GET['type'];
} else {
    $type = 'OTHER';
}

if((isset($_GET['form_name'])) && ($_GET['form_name'] != '')){
    $form_name = $_GET['form_name'];
} else {
   die();
}

if((isset($_GET['applicant_name'])) && ($_GET['applicant_name'] != '')){
    $applicant_name = $_GET['applicant_name'];
} else {
   die();
}

if((isset($_GET['number'])) && ($_GET['number'] != '')){
    $number = $_GET['number'];
} else {
   die();
}

if((isset($_GET['email'])) && ($_GET['email'] != '')){
    $email = $_GET['email'];
} else {
   die();
}

if((isset($_GET['status'])) && ($_GET['status'] != '')){
    $status = $_GET['status'];
} else {
   $status = 'Unpaid';
}

if((isset($_GET['price'])) && ($_GET['price'] != '')){
    $price = $_GET['price'];
} else {
   $price = 0;
}

if((isset($_GET['form_id'])) && ($_GET['form_id'] != '')){
    $form_id = $_GET['form_id'];
} else {
   die();
}

if((isset($_GET['track'])) && ($_GET['track'] != '')){
    $track = $_GET['track'];
} else {
   $track = 'Unpaid';
}

if((isset($_GET['date'])) && ($_GET['date'] != '')){
    $date = $_GET['date'];
} else {
   date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
}
require_once("../config/db.php");
$sql_assign = "SELECT users.id as user_id,users.username, (SELECT COUNT(forms.sales_id) FROM forms WHERE forms.sales_id = users.id GROUP BY forms.sales_id HAVING forms.sales_id = users.id) as number_of_asaign FROM `users` WHERE users.roll_type_id in(SELECT roll_types.id FROM roll_types WHERE roll_types.roll = 'SALE') ORDER BY number_of_asaign ASC LIMIT 1;";
    $result_assign = $conn->query($sql_assign);

    if ($result_assign->num_rows > 0) {
      while($row_assign = $result_assign->fetch_assoc()) {
         $assign_id = $row_assign["user_id"];
      }
    } else{
        $assign_id = 0;
    }
$sql = "INSERT INTO `forms` (`web`, `type`, `form_name`, `name`, `number`, `email`, `status`, `price`, `form_id`, `track_status`,`form_date`,`sales_id`) VALUES ('$website','$type','$form_name','$applicant_name','$number','$email','$status','$price','$form_id','$track','$date','$assign_id')";

if ($conn->query($sql) === TRUE) {
echo $conn->insert_id;
} else {
echo false;
}


?>