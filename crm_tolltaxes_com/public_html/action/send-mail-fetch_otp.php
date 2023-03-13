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
require_once("../web-data/mail-template/".$web."/otp.php");
//sending mail
$mail = new PHPMailer;
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host       = 'smtp.hostinger.in';
$mail->SMTPAuth   = true;
$mail->Username   = "no-reply@".$web;
$mail->Password   = "freeDOM@091#";
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->setFrom("no-reply@".$web,$web_setFrom);
$mail->addAddress($user_email_id);
$mail->isHTML(true);
$mail->Subject = $web_Subject;
$mail->Body    = $web_Body;
if(!$mail->send()) {
    echo '<script>console.log("Mailer Error: ' . $mail->ErrorInfo.'");</script>';
} else {
echo "true";
}



}
?>
