<?php
require("config.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$sql =
"
    SELECT form_name, applicant_name, email_id, mobile_number,total_amount, payment_id, order_id, payment_status
    FROM ".$_SESSION['table_id']."
    WHERE id = '".$_SESSION["form_id"]."';
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
                    Your FASTag Recharge is <span style='color:green'>successfully</span> .We glad to know that you apply for FASTag from aur website, Here's your confirmation for order number ".$row['order_id'].". Review your receipt.
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
                    Your application along with payment has been received and at the time of processing, we will call you in next 4 - 48 working hours for further process on recharge.<br>
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUCCESS | FASTAG Online Registeration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        table#fcs-fee-table {
            font-size: 14px;
            background: #ffffff;
            text-transform: uppercase;
        }

        table#fcs-fee-table td:nth-child(1) {
            background: #f8f8f8;
            font-weight: 700;
        }

        form {
            background: #ffffff;
            padding: 60px;
            height: 100%;
        }

        .fcs-bold-text-white {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 30px;
    display: block;
        }


    </style>
</head>
<body>
  <html>
  <head>
  <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="style.css">

  </head>
  <body>
  <div class="nav-wrap">
      <div id="nav-icon" onclick="w3_open()"></div>
      <div class="logo">
        <a href="/"><img src="https://www.npci.org.in/images/npci/logo.png" alt="FasTag Logo"></a>
      </div>
      <div id="top-nav">
        <ul class="menu">
          <li style="border-right: 2px solid #f8f8f8;"><a href="/">FASTAG</a></li>
          <li style="border-right: 2px solid #f8f8f8;"><a href="./enquiry.php">ENQUIRY</a></li>
          <!-- <li><a href="fees-and-charges.php">Fees and Charges</a></li> -->
          <li style="border-right: 2px solid #f8f8f8;"><a href="./faqs.php">FAQs</a></li>
          <li style=""><a href="./blog-post/">BLOG</a></li>
          <!-- <li style="border-right: 2px solid #f8f8f8;" ><a href="./complaint-form.php">COMPLAINT</a></li>
          <li><a href="./complaint-track-form.php">TRACK COMPLAINT</a></li> -->

        </ul>
      </div>
      <div style=""  class="googe_searchbar"id="google_search_input">
      </div>
    </div>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none;width:0;" id="mySidebarfast">
      <span   class="w3-bar-item w3-large">Menu <span onclick="w3_close()"style="margin-left: 51%;" >&times;</span></span>
      <a href="/" class="w3-bar-item w3-button">FASTAG</a>
      <a href="./enquiry.php" class="w3-bar-item w3-button">ENQUIRY</a>
      <a href="./faqs.php" class="w3-bar-item w3-button">FAQs</a>
      <a href="./blog-post/" class="w3-bar-item w3-button">BLOG</a>
      <a href="./complaint-form.php" class="w3-bar-item w3-button">COMPLAINT</a>
      <a href="./complaint-track-form.php" class="w3-bar-item w3-button">TRACK COMPLAINT</a>
    </div>
  <script>
  function w3_open() {
    document.getElementById("mySidebarfast").style.display = "block";
    document.getElementById("mySidebarfast").style.width = "auto";
  }

  function w3_close() {
    document.getElementById("mySidebarfast").style.display = "none";
    document.getElementById("mySidebarfast").style.width = "0";
  }
  </script>
  </body>
  </html>
  <!-- Global site tag (gtag.js) - Google Ads: 436242631 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-436242631"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-436242631');
  </script>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./assets/img/FasTag_3003.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="./assets/img/fastag-banner.png" class="d-block w-100" alt="...">
            </div>
       </div>
</div>
    <div class="container-fluid fcs-form-container">
        <div class="row">
            <div class="col-sm-8 col-lg-6" style="margin: auto">
                <?php
                $sql =
                "
                    SELECT applicant_name, email_id, mobile_number, total_amount, payment_status
                    FROM ".$_SESSION['table_id']."
                    WHERE id = '".$_SESSION["form_id"]."';
                ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <form>
                    <span class="fcs-bold-text-white">PAYMENT SUCCESSFUL</span>

                    <table class="table table-bordered fcs-fee-table" id="fcs-fee-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ORDER DETAILS</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    APPLICANT NAME
                                </td>
                                <td>
                                    <?php echo $row['applicant_name']; ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    EMAIL ID
                                </td>
                                <td>
                                    <?php echo $row['email_id']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    MOBILE NUMBER
                                </td>
                                <td>
                                    <?php echo $row['mobile_number']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    AMOUNT PAID
                                </td>
                                <td>
                                    <?php echo $row['total_amount']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    PAYMENT ID
                                </td>
                                <td>
                                    <?php echo $_SESSION['razorpay_payment_id']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ORDER ID
                                </td>
                                <td>
                                    <?php echo $_SESSION['order_id']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    PAYMENT STATUS
                                </td>
                                <td>
                                    <?php echo $row['payment_status']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>


            </div>
        </div>
    </div>
    </div>



    <?php include "footer.php"; ?>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <!-- <script src="./assets/js/nav.js"></script> -->
    <script src="./assets/js/util.js"></script>
    <script src="./assets/js/main.js"></script>

<!-- Event snippet for Purchase conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-436242631/l8XPCL_KgfQBEMeRgtAB',
      'transaction_id': ''
  });
</script>
</body>
</html>
