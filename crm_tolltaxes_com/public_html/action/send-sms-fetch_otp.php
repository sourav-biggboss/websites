<?php
if(isset($_GET['id'])){
require_once("../config/db.php");
require('../razorpay-php/Razorpay.php');
require_once('../lib/mail/PHPMailerAutoload.php');
require_once('../lib/mail/credential.php');
$query = "SELECT * FROM `forms` WHERE `id` ='".$_GET['id']."'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result) != 1) { die ('<script>console.log("row not founnd '.$_GET['form_id'].'!");</script>'); }
$row= mysqli_fetch_array($result);
$applicant_name = $row['name'];
$mobile_number = $row['number'];
$user_email_id = $row['email'];
$web = $row['web'];
$form_name = $row['form_name'];
if((empty($applicant_name))||($applicant_name == "")){$mail_applicant_name = "Sir / Maam";}else {$mail_applicant_name = ucwords(strtolower($applicant_name));}
//getting mail body,subject,mailform according to website
require_once("../web-data/sms-template/".$web."/otp.php");
//sending mail
$apiKey = $apiKey;
	
	// Message details
	$numbers = urlencode($mobile_number);
	$sender = urlencode($sms_sender);
	$message = urlencode($sms_body);

	
	$curl_handle_sms = curl_init();
    $url_sms_api = "https://www.fast2sms.com/dev/bulkV2?authorization=".$apiKey."&route=v3&sender_id=".$sender."&message=".$message."&language=english&flash=0&numbers=".$numbers."";
    curl_setopt($curl_handle_sms, CURLOPT_URL, $url_sms_api);
    curl_setopt($curl_handle_sms, CURLOPT_RETURNTRANSFER, true);
    $curl_data_sms = curl_exec($curl_handle_sms);
    curl_close($curl_handle_sms);
	
	// Process your response here
	$response = json_decode($curl_data_sms,true);
    if($response['return'] == 'true') {
        echo "true";
    } else {
    echo "false";
    }



}
?>
