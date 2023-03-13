<?php
if((isset($_GET['id']))&&(isset($_GET['table']))) {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FASTAG ONLINE</title>
  <link rel="icon" href="./assets/img/flag.png" type="image/gif" sizes="16x16">
  <script src="https://kit.fontawesome.com/d23a55b7f1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    input.razorpay-payment-button {
      display: none;
    }
.border-list > *:last-child {
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
    pointer-events: none !important;
    cursor: not-allowed !important;
}
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner">
   		    <div class="carousel-item active">
   		      <img src="/assets/img/FasTag_3003.jpg" class="d-block w-100" alt="...">
   		    </div>
   		    <div class="carousel-item">
   		      <img src="/assets/img/fastag-banner.png" class="d-block w-100" alt="...">
   		    </div>
       </div>
     </div>
    <form  id="pay" action="late-pay.php" method="post">
        <input name="id" type="hidden" value="<?php echo$_GET['id'];  ?>" >
         <input name="table" type="hidden" value="<?php echo$_GET['table'];  ?>" >
         <input id="submit" name="submit" type="submit" value="submit" style="display:none;">
    </form>
    <script>
        document.getElementById("submit").click();
    </script>
     <?php include 'footer.php'; ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Custom JS -->
  <script src="./assets/js/nav.js"></script>
  <script src="./assets/js/util.js"></script>
  <script src="./assets/js/main.js"></script>
</body>
</html>

    <?php
    exit;}
//   if((empty($_POST['id']))&&(empty($_POST['table']))) {die ("error 404");}
  session_start();
  date_default_timezone_set('Asia/Kolkata');
  $date=date('d-m-Y H:i:s');

  require_once("config.php");
  $id = $_POST['id'];
  $table = $_POST['table'];
  require_once("admin/info-of-client.php");

  $_SESSION['table_id'] = $table;
  $_SESSION["form_id"] = $form_id;
  
    function generate($length = 7) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $token = '';
    while(strlen($token) < $length) {
    $token .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return 'ORDER_' . $token;
    }
    $_SESSION["orderId"] = $orderId = generate(13);

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/autoload.php';

 // cashfree payment
            $secretKey = CASHFREE_KEY_SECRET;
            $postData = array(
                "appId" => CASHFREE_APP_ID,
                "orderId" => $orderId,
                "orderAmount" => $price,
                "orderCurrency" => "INR",
                "customerName" => $name,
                "customerPhone" => $number,
                "customerEmail" => $email,
                "returnUrl" => RETURN_URL,
                "notifyUrl" => NOTIFY_URL,
            );
    
            // get secret key from your config
            ksort($postData);
            $signatureData = "";
            foreach ($postData as $key => $value) {
                $signatureData .= $key.$value;
            }
            $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
            $signature = base64_encode($signature);
    
            $sql_update_msme_form = 'UPDATE fastag_form SET order_id = "'.$orderId.'" WHERE id = "'.$_SESSION['form_id'].'"';
            $result_update_msme_form = $conn->query($sql_update_msme_form);
    
?>
                 <form id="redirectForm" method="post" action="<?php echo REQUEST_URL; ?>">
                <input type="hidden" name="appId" value="<?php echo CASHFREE_APP_ID; ?>"/>
                <input type="hidden" name="orderId" value="<?php echo $orderId; ?>"/>
                <input type="hidden" name="orderAmount" value="<?php echo $price; ?>"/>
                <input type="hidden" name="orderCurrency" value="<?php echo "INR"; ?>"/>
                <input type="hidden" name="customerName" value="<?php echo $name; ?>"/>
                <input type="hidden" name="customerEmail" value="<?php echo $email; ?>"/>
                <input type="hidden" name="customerPhone" value="<?php echo $number; ?>"/>
                <input type="hidden" name="returnUrl" value="<?php echo RETURN_URL; ?>"/>
                <input type="hidden" name="notifyUrl" value="<?php echo NOTIFY_URL; ?>"/>
                <input type="hidden" name="signature" value="<?php echo $signature; ?>"/>
            </form>
            <script>document.getElementById("redirectForm").submit();</script>


