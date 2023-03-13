<?php
require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/config/db.php");
require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/web-data.json.inc.php");
require('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/razorpay-php/Razorpay.php');
//require('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/mail-list.php');
//require('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/class/email-validation.php');
require_once('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/lib/mail/PHPMailerAutoload.php');
require_once('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/lib/mail/credential.php');
set_time_limit(0);
ob_flush();

//randowm emial checking score
/*$list_mail = rand(0,count($campaign_mail_list) - 1);
if (8 >= 8) {
  $sender_email_id = $campaign_mail_list[$list_mail];
} else {
  for ($i=1; $i < count($campaign_mail_list); $i++) {
     if (8 >= 8) {
     $sender_email_id = $campaign_mail_list[$i];
     }
  }
}*/
if (empty($sender_email_id)) {
  $sender_email_id = 'ads@';
}



$sql_campain_log = "SELECT * FROM `campain_log`  where status = 1";
$result_campain_log = mysqli_query($conn,$sql_campain_log);
if (mysqli_num_rows($result_campain_log) > 0) {
  while($row_campain_log = $result_campain_log->fetch_assoc()) {
  //campin one
  if($row_campain_log['campain_type'] == 'MAIL'){
      //mail campin


      $sql_campain_data = "SELECT * FROM `campain_data` WHERE type = '".$row_campain_log['type']."' and send = 0";
      $result_campain_data = mysqli_query($conn,$sql_campain_data);
      if ($result_campain_data->num_rows > 0) {
         while($row_campain_data = $result_campain_data->fetch_assoc()) {

            //one user
            $applicant_id = $row_campain_data['id'];
            $applicant_name = $row_campain_data['name'];
            $mobile_number = $row_campain_data['number'];
            $user_email_id = $row_campain_data['email'];
            $host_name = $web = $row_campain_log['web'];
            $campain_text = $row_campain_log['sbj'];
            $web_type = $row_campain_data['type'];

             if((empty($applicant_name))||($applicant_name == "")){$mail_applicant_name = "Sir / Maam";}else {$mail_applicant_name = ucwords(strtolower($applicant_name));}

             require("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/mail-template/".strtoupper($web)."/campain.php");

             if (filter_var($user_email_id, FILTER_VALIDATE_EMAIL)) {

             //sending mail
            $mail = new PHPMailer;
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.in';
            $mail->SMTPAuth   = true;
            $mail->Username   = $sender_email_id.strtolower($web);
            $mail->Password   = "skill@0Rs";
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->setFrom($sender_email_id.strtolower($web),$web_setFrom);
            $mail->addAddress($user_email_id);
            $mail->isHTML(true);
            $mail->Subject = $web_Subject;
            $mail->addCustomHeader('Reply-To', $sender_email_id.strtolower($web));
            $mail->addCustomHeader('Return-Path', $sender_email_id.strtolower($web));
            //$mail->addCustomHeader('MIME-Version', "1.0");
            $mail->addCustomHeader('X-Priority', "3");
            $mail->addCustomHeader('X-Mailer', "PHP". phpversion() ."");
            $mail->Body    = $web_Body;
            if($mail->send()) {
            $conn->query("UPDATE `campain_data` SET `send`= `send` + '1' WHERE id ='".$row_campain_data['id']."'");
            $conn->query("UPDATE `campain_log` SET `total_sended`= `total_sended` + '1' WHERE id ='".$row_campain_log['id']."'");
            } else{
                echo "failed 1";
            }

         }
            $conn->query("UPDATE `campain_log` SET `last_id`='".$row_campain_data['id']."' WHERE id ='".$row_campain_log['id']."'");

         }
      } else {  echo "NO CAMPIN DATA FOUND!:";}


  }
  //






  }
} else {  echo "NO CAMPIN FOUND!:";}
$conn->close();
echo "DONE : ".date("Y-m-d h:i:sa")."\n";
?>
