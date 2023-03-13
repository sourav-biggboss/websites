<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $web = $_GET['website'];
} else {
    $web = strtoupper($_SERVER['SERVER_NAME']);
}
if((isset($_GET['otp'])) && ($_GET['otp'] != '')){
    $otp = $_GET['otp'];
} else {
    die();
}
if((isset($_GET['form_id'])) && ($_GET['form_id'] != '')){
    $form_id = $_GET['form_id'];
} else {
   die();
}
require_once("../config/db.php");
$sql = "UPDATE `forms` SET `user_otp`='$otp' WHERE `web` = '$web' AND `id`= '$form_id'";

if ($conn->query($sql) === TRUE) {
echo true;
} else {
echo false;
}


?>