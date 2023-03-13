<?php
require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/config/db.php");
require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/web-data.json.inc.php");
require('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/razorpay-php/Razorpay.php');
require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/web-data.json.inc.php");
require_once('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/lib/mail/PHPMailerAutoload.php');
require_once('/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/lib/mail/credential.php');
set_time_limit(0);
ob_flush();
if (empty($sender_email_id)) {
  $sender_email_id = 'ads@';
}



$sql_campain_log = "SELECT * FROM `campain_log`  where status = 2";
$result_campain_log = mysqli_query($conn,$sql_campain_log);
if (mysqli_num_rows($result_campain_log) > 0) {
  while($row_campain_log = $result_campain_log->fetch_assoc()) {
   //campin one
   if($row_campain_log['campain_type'] == 'MAIL'){
       //mail campin


       $sql_campain_data = "SELECT * FROM `forms` WHERE type = '".$row_campain_log['type']."' and `web` = '".$row_campain_log['web']."' and status = 'Unpaid' and send_mail = 0";
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
            $table_name = $web_data[$web]['table'][$web_type];
            $campaign_link = 'https://'.strtolower($web).'/late-pay.php?id='.$applicant_id.'&table='.$table_name.'';

             if((empty($applicant_name))||($applicant_name == "")){$mail_applicant_name = "Sir / Maam";}else {$mail_applicant_name = ucwords(strtolower($applicant_name));}

             require("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/mail-template/".strtoupper($web)."/campaign-reminder1.php");

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
            $conn->query("UPDATE `forms` SET `send_mail`= `send_mail` + '1' WHERE id ='".$row_campain_data['id']."'");
            $conn->query("UPDATE `campain_log` SET `total_sended`= `total_sended` + '1' WHERE id ='".$row_campain_log['id']."'");
            } else{
                echo "failed 1";
            }

         }
            $conn->query("UPDATE `campain_log` SET `last_id`='".$row_campain_data['id']."' WHERE id ='".$row_campain_log['id']."'");

         }
       } else {  echo "NO CAMPIN DATA FOUND!MAIL:";}


   }
   // whatsapp
     if($row_campain_log['campain_type'] == 'WHATSAPP'){
       $sql_campain_data = "SELECT * FROM `forms` WHERE type = '".$row_campain_log['type']."' and `web` = '".$row_campain_log['web']."' and status = 'Unpaid' and send_whatsapp = 0";
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
            $table_name = $web_data[$web]['table'][$web_type];
            $campaign_link = 'https://'.strtolower($web).'/late-pay.php?id='.$applicant_id.'&table='.$table_name.'';

             if((empty($applicant_name))||($applicant_name == "")){$mail_applicant_name = "Sir / Maam";}else {$mail_applicant_name = ucwords(strtolower($applicant_name));}

             require("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/whatsapp-template/".strtoupper($web)."/campaign-reminder1.php");
             $curl_handle_whatsapp = curl_init();
             $url_whatsapp_api = "https://messageapi.in/MessagingAPI/sendMessageDouble.php?LoginId=".urlencode($auth_number)."&password=".urlencode($auth_pass)."&mobile_number=".urlencode('91'.$mobile_number)."&message=".urlencode($whatsapp_msg)."&fileUrl=".$whatapp_file."";
            curl_setopt($curl_handle_whatsapp, CURLOPT_URL, $url_whatsapp_api);
            curl_setopt($curl_handle_whatsapp, CURLOPT_RETURNTRANSFER, true);
            $curl_data_whatsapp = curl_exec($curl_handle_whatsapp);
            curl_close($curl_handle_whatsapp);
            $response_data_whatsapp_api_abj = json_decode($curl_data_whatsapp);
            if($curl_data_whatsapp == 'success'){
                $conn->query("UPDATE `forms` SET `send_whatsapp`= `send_whatsapp` + '1' WHERE id ='".$row_campain_data['id']."'");
                $conn->query("UPDATE `campain_log` SET `total_sended`= `total_sended` + '1' WHERE id ='".$row_campain_log['id']."'");
            }

            $conn->query("UPDATE `campain_log` SET `last_id`='".$row_campain_data['id']."' WHERE id ='".$row_campain_log['id']."'");

         }
      } else {  echo "NO CAMPIN DATA FOUND!:";}


  }
      // SMS
     if($row_campain_log['campain_type'] == 'SMS'){
      $sql_campain_data = "SELECT * FROM `forms` WHERE type = '".$row_campain_log['type']."' and `web` = '".$row_campain_log['web']."' and status = 'Unpaid' and send_sms = 0";
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
            $table_name = $web_data[$web]['table'][$web_type];
            $campaign_link = 'https://'.strtolower($web).'/late-pay.php?id='.$applicant_id.'&table='.$table_name.'';

             if((empty($applicant_name))||($applicant_name == "")){$mail_applicant_name = "Sir / Maam";}else {$mail_applicant_name = ucwords(strtolower($applicant_name));}

             require("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/web-data/sms-template/".strtoupper($web)."/campaign-reminder1.php");

             $apiKey_sms = $apiKey_sms;
        	$apiKey_sms_number = $mobile_number;
        	$sms_sender = urlencode($sms_sender);
        	$sms_message = urlencode($sms_body);
        	$apiKey_sms_number = $apiKey_sms_number;


        	$curl_handle_sms = curl_init();
            $url_sms_api = "https://www.fast2sms.com/dev/bulkV2?authorization=".$apiKey_sms."&route=v3&sender_id=".$sms_sender."&message=".$sms_message."&language=english&flash=0&numbers=".$apiKey_sms_number."";
            curl_setopt($curl_handle_sms, CURLOPT_URL, $url_sms_api);
            curl_setopt($curl_handle_sms, CURLOPT_RETURNTRANSFER, true);
            $curl_data_sms = curl_exec($curl_handle_sms);
            curl_close($curl_handle_sms);

            if(json_decode($curl_data_sms,true)['return'] == 'true'){
                $conn->query("UPDATE `forms` SET `send_sms`= `send_sms` + '1' WHERE id ='".$row_campain_data['id']."'");
                $conn->query("UPDATE `campain_log` SET `total_sended`= `total_sended` + '1' WHERE id ='".$row_campain_log['id']."'");
            }

            $conn->query("UPDATE `campain_log` SET `last_id`='".$row_campain_data['id']."' WHERE id ='".$row_campain_log['id']."'");

         }
      } else {  echo "NO CAMPIN DATA FOUND! SMS:";}


  }






  }
} else {  echo "NO CAMPIN FOUND!:";}
$conn->close();
echo "DONE : ".date("Y-m-d h:i:sa")."\n";
?>
