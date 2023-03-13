<?php
require('config.php');
// require("config-panel.php");
session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $payment        = $api->payment->fetch($_POST['razorpay_payment_id']);
    $payment_status = ucfirst($payment->status);
    $order_id       = $payment->order_id;

    $_SESSION['razorpay_payment_id'] = $_POST['razorpay_payment_id'];
    $_SESSION['payment_status']      = $payment_status;
    $_SESSION['order_id']            = $order_id;

    if($payment_status == 'Captured') {
        $payment_status = 'Paid';
    }

    $sql = "
    UPDATE ".$_SESSION['table_id']." 
    SET payment_id = '".$_POST['razorpay_payment_id']."', 
    order_id = '$order_id', 
    payment_status = '$payment_status'
    where 
    id = '".$_SESSION["form_id"]."'
    ";

    if(!$result = $conn->query($sql)){
        die('There was an error running the query [' . $conn->error . ']');
    }

    require("admin/success-paid-client.php");
    form_to_paid($_SESSION["form_id"]);
        $sql = " SELECT `form_name` FROM `".$_SESSION['table_id']."` WHERE `id` = '".$_SESSION["form_id"]."' ";
    $result = $conn->query($sql);
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc() ; $form_name_db = $row['form_name'];
    } else {
      die('error 404');
    }

    if ($row['form_name'] == "Fastag Recharge") {
      header("Location: ./success-recharge.php"); exit;
    }
    header("Location: ./success.php");
}
else
{
    header("Location: ./failure.php");
}
?>