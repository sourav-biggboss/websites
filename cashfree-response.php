<?php
session_start();
ob_start();

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
    return 'SAVE_RESPONSE_' . strtoupper($token);
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
            $sql = "
            UPDATE fastag_form
            SET payment_id = '".$referenceId."', 
            order_id = '$orderId', 
            payment_status = 'Paid'
            WHERE order_id = '".$orderId."'";
        
            if(!$result = $conn->query($sql)){
                die('There was an error running the query [' . $conn->error . ']');
            }

        $_SESSION['orderId'] = $orderId;
        

        $sql = "SELECT * FROM fastag_form WHERE order_id = '".$orderId."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
            require("admin/success-paid-client.php");
            form_to_paid($row['id']);
        

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.in';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'order@tolltaxes.com';
            $mail->Password   = 'freeDOM@091#';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom("order@tolltaxes.com", "Fastag Payment");
            $mail->addAddress("".$row['email_id']."");
            $mail->isHTML(true);
            $mail->Subject = "Payment Successful For ".$row['form_name']."";
            $mail->Body    = "<body style='color:#000;'>
                            <div style='padding: 15px 0px 25px 0px;text-align:center;'><span style='display: flex;color:#225643;font-size:40px;font-weight:900;'><div style='width: -webkit-fill-available;'><div style=' height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div><div style='white-space: nowrap;'>FASTag Payment</div><div style='width: -webkit-fill-available;'><div style='height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div></span>
                            <span style='color:#000000;font-size:16px;font-weight:900'>Toll Taxes</span>
                            </div>
                            Thanks for your order, <strong>".ucwords($row['applicant_name'])."</strong>
                            <br><br>
                            Greetings of the day !!<br><br>
                            Your FASTag Registration Form is submitted <span style='color:green'>successfully</span> .We glad to know that you apply for FASTag from aur website, Here's your confirmation for order number ".$row['order_id'].". Review your receipt.
                            <br><br>
                            <table>
                            <tbody>
                            <tr><th colspan='4' style='padding:10px;background-color:#225643;font-weight:bold;color:#fff;font-weight:bold'>Your Receipt</th></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>NAME : </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>".strtoupper($row["applicant_name"])."</td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>EMAIL : </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'><a style='text-decoration:none;color:#000;'>".strtoupper($row['email_id'])."</a></td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>NUMBER : </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>".strtoupper($row['mobile_number'])."</td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>AMOUNT PAID: </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>".strtoupper($row['total_amount'])."</td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>PAYMENT ID: </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>".strtoupper($row["payment_id"])."</td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>ORDER ID: </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>".strtoupper($row['order_id'])."</td></tr>
                            <tr><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>PAYMENT STATUS: </td><td style='padding:10px;font-weight:bold;background-color: #ddd;font-weight:bold'>PAID</td></tr>
                            </tbody>
                            </table>
                            <br>
                            <b>Note:</b><br><br>
                            1) Your application along with payment has been received and we will call you in next 4 - 48 working hours.<br>
                            2) At the time of processing, one link will be sent to you for OTP collection. We collect OTP only through system generated automatic links, linked to client's application to reduce human intervention.</strong><br>
                            3) Normally FASTag generation takes 1 - 5 working days. However due to restrictions placed by COVID-19, this may take longer than usual.<br>
                            
                            Your application has been queued up for processing and the final FASTag will be sent on your registered address
                            within 5 - 10 working days.
                            <br><br>
                            We expect your cooperation for the same. <br>
                            <br>
                            Regards,<br>
                            Team Processing,<br>
                            For Any Enquiry: care@tolltaxes.com
                            </div>
                            <div style='text-align: center;padding: 20px 0px;color: gray;'>
                              <div style='margin-bottom: 5px;'>Toll Taxes © 2021</div>
                              <div><a href='https://www.tolltaxes.com/disclaimer.php' style='text-decoration: none;color: gray;'>About</a></div>
                            </div>
                            </body>";
        
            $mail->send();
        
            $mail->ClearAllRecipients();
        
            $mail->addAddress("admin@tolltaxes.com");
            $mail->isHTML(true);
            $mail->Subject = "Payment Received For ".$row["form_name"]."";
            $mail->Body    = "
                            APPLICANT NAME: ".$row["applicant_name"]."<br>
                            EMAIL ID: ".$row['email_id']."<br>
                            MOBILE NUMBER: ".$row['mobile_number']."<br>
                            AMOUNT PAID: ".$row['total_amount']."<br>
                            PAYMENT ID: ".$row["payment_id"]."<br>
                            ORDER ID: ".$row['order_id']."<br>
                            PAYMENT STATUS: Paid
                            ";
        
            $mail->send();
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header ('location: success.php');
    } else {
        echo 'Payment Failed';
    }
} else {
    echo 'Payment Failed';
}
?>
