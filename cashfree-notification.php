<?php
session_start();

include_once('./config.php');
include_once('./vendor/autoload.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generate($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return 'SAVE_NOTIFICATION_' . strtoupper($token);
}

$response = file_get_contents('php://input');
file_put_contents('./cashfree-log/'.generate(13), $response);
$data = explode('&', urldecode($response));

$secretKey = CASHFREE_KEY_SECRET;
$orderId = $_POST["orderId"];
$orderAmount = $_POST["orderAmount"];
$referenceId = $_POST["referenceId"];
$txStatus = $_POST["txStatus"];
$paymentMode = $_POST["paymentMode"];
$txMsg = $_POST["txMsg"];
$txTime = $_POST["txTime"];
$signature = $_POST["signature"];
$data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
$hash_hmac = hash_hmac('sha256', $data, $secretKey, true) ;
$computedSignature = base64_encode($hash_hmac);
if ($signature == $computedSignature) {
    if ($txStatus == 'SUCCESS') {
        $sql = "SELECT * FROM msme_form WHERE order_id = '".$orderId."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $post = [
            "account_id" => CASHFREE_APP_ID,
            "event" => "SUCCESS",
            "payment_id" => $referenceId,
            "order_id" => $orderId,
            "amount" => $orderAmount,
            "email" => $row['email_id'],
            "mobile" => $row['mobile_number']
        ];
        
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $ch = curl_init('http://localhost/crm.tolltaxes.com/api/cashfree-notification.php');
        } else {
            $ch = curl_init('https://crm.tolltaxes.com/api/cashfree-notification.php');
        }
        $sql_select_form = "select `id` from fastag_form where order_id = '$orderId'";
        $result_select_form = $conn->query($sql_select_form);
        if($result_select_form->num_rows == 1){
            $row_select_form = $result_select_form->fetch_assoc();
            require("admin/success-paid-client.php");
            form_to_paid($row_select_form['id']);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $response;
    }
}

?>