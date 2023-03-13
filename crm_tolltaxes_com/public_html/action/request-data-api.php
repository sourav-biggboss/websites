<?php
// date_default_timezone_set("Asia/Calcutta");
// set_time_limit(0);
// ob_flush();
// require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/config/db.php");
// $bussness = 'MSME';
// $form_name = '';
// $to_date = date('d-m-Y');
// $from_date = date('d-m-Y',(strtotime ( '-1 day' , strtotime ( $to_date) ) ));
// $sqls = "SELECT name,email , mobile,status FROM forms WHERE (email NOT in(
// SELECT `merchant_name` FROM `website_list`
// UNION
// SELECT `personal_email_id` FROM `employee`
// UNION
// SELECT `company_email_id` FROM `employee`
// UNION
// SELECT `user_email` FROM `users`
// UNION
// SELECT `registered_id` FROM `soft_data`
// UNION
// SELECT `recovery_email` FROM `soft_data`
// )
// OR mobile not in(
// SELECT `mobile` FROM `website_list`
// UNION
// SELECT `personal_mobile_number` FROM `employee`
// UNION
// SELECT `emergency_contact_1` FROM `employee`
// UNION
// SELECT `emergency_contact_2` FROM `employee`
// UNION
// SELECT `company_mobile_number` FROM `employee`
// UNION
// SELECT `user_mobile` FROM `users`
// UNION
// SELECT `user_whatsapp_mobile` FROM `users`
// UNION
// SELECT `phone` FROM `soft_data`
// UNION
// SELECT `recovery_mobile` FROM `soft_data`
// ))
// and mobile not in('1234567890','1111111111','2222222222','3333333333','4444444444','5555555555','6666666666','7777777777','8888888888','9999999999','0000000000','9876543210')
// AND form_id NOT LIKE '%,%,%'
// and status = 'Unpaid'
// and business = '".$bussness."'
// AND(name NOT LIKE '%test%' OR name NOT LIKE '%dummy%')
// AND(email NOT LIKE '%test%' OR email NOT LIKE '%dummy%')
// AND(remarks NOT LIKE '%test%' OR remarks NOT LIKE '%dummy%')
// AND STR_TO_DATE(date, '%d-%m-%Y %T') BETWEEN STR_TO_DATE('".$from_date." 00:00:01', '%d-%m-%Y %T') AND STR_TO_DATE('".$to_date." 13:00:59', '%d-%m-%Y %T') GROUP BY `email` HAVING `status` != 'Paid'";
// $data_feld = [
//     'number' => 'invoice_number',
//     'invoice' => openssl_encrypt($sqls,"AES-128-ECB","freeDOM@911#")
//     ];
// $curl = curl_init('https://crm2.techlounge.co.in/classes/request-data-api.php');
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data_feld));
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// $response_date = curl_exec($curl);
// $cmpn =    json_decode($response_date,true);
// for ($x = 0; $x < count($cmpn); $x++) {
//   $sql_inter = "INSERT INTO `campain_data`(`type`, `form_name`, `name`, `number`, `email`, `send`) VALUES ('".$bussness."','".$form_name."','".$cmpn[$x]['name']."','".$cmpn[$x]['mobile']."','".$cmpn[$x]['email']."','0')";
//     if(!mysqli_query($conn,$sql_inter)){
//         echo "failed";
//     }
// }
// echo "Done:".$to_date;

?>