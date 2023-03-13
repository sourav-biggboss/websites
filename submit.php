<?php
    require("config.php");
    include("admin/crm-form-action.php");
    // require("config-panel.php");
    require('razorpay-php/Razorpay.php');
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    $date=date('Y-m-d H:i:s');

    function generate($length = 7) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return 'ORDER_' . $token;
    }
    $orderId = generate(13);

    use Razorpay\Api\Api;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    //FASTAG
    if(
        (isset($_POST['form_id'])&& $_POST['form_id'] == 'fastag_form')
    )
    {
        $applicant_name   = urlencode($_POST['applicant_name']);
        $mobile_number    = urlencode($_POST['mobile_number']);
        $email_id         = urlencode($_POST['email_id']);

        $_SESSION['table_id'] = 'fastag_form';
        $payment_status = 'Unpaid';

        if ($_POST['form_name'] == 'FASTAG Form') {
            $product_price = 1499;
        }

        $cur_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] ;

        if ($_FILES["upload_rc"]["name"] != '') {
            $upload_rc = urlencode($_FILES["upload_rc"]["name"]);

            if (pathinfo($upload_rc, PATHINFO_EXTENSION)=='pdf') {
                $_SESSION['upload_rc'] = rand().'.pdf';
            } else {
                $_SESSION['upload_rc'] = rand().'.jpeg';
            }

            $upload_rc_tmp = $_FILES["upload_rc"]["tmp_name"];
            move_uploaded_file($upload_rc_tmp, "uploads/fastag/".$_SESSION['upload_rc']."");
            $upload_rc_link = ''.$cur_url.'/uploads/fastag/'.$_SESSION["upload_rc"].'';
        } else {
            $upload_rc_link = '';
        }

        if ($_FILES["upload_pan_card"]["name"] != '') {
            $upload_pan_card = urlencode($_FILES["upload_pan_card"]["name"]);

            if (pathinfo($upload_pan_card, PATHINFO_EXTENSION)=='pdf') {
                $_SESSION['upload_pan_card'] = rand().'.pdf';
            } else {
                $_SESSION['upload_pan_card'] = rand().'.jpeg';
            }

            $upload_pan_card_tmp = $_FILES["upload_pan_card"]["tmp_name"];
            move_uploaded_file($upload_pan_card_tmp, "uploads/fastag/".$_SESSION['upload_pan_card']."");
            $upload_pan_card_link = ''.$cur_url.'/uploads/fastag/'.$_SESSION["upload_pan_card"].'';
        } else {
            $upload_pan_card_link = '';
        }

        if ($_FILES["upload_aadhaar_voter_dl_passport"]["name"] != '') {
            $upload_aadhaar_voter_dl_passport = urlencode($_FILES["upload_aadhaar_voter_dl_passport"]["name"]);

            if (pathinfo($upload_aadhaar_voter_dl_passport, PATHINFO_EXTENSION)=='pdf') {
                $_SESSION['upload_aadhaar_voter_dl_passport'] = rand().'.pdf';
            } else {
                $_SESSION['upload_aadhaar_voter_dl_passport'] = rand().'.jpeg';
            }

            $upload_aadhaar_voter_dl_passport_tmp = $_FILES["upload_aadhaar_voter_dl_passport"]["tmp_name"];
            move_uploaded_file($upload_aadhaar_voter_dl_passport_tmp, "uploads/fastag/".$_SESSION['upload_aadhaar_voter_dl_passport']."");
            $upload_aadhaar_voter_dl_passport_link = ''.$cur_url.'/uploads/fastag/'.$_SESSION["upload_aadhaar_voter_dl_passport"].'';
        } else {
            $upload_aadhaar_voter_dl_passport_link = '';
        }


        $sql="
            INSERT INTO fastag_form (
                form_name,
                applicant_name,
                last_name,
                mobile_number,
                email_id,
                mothers_name,
                date_of_birth,
                gender,
                vehicle_registration_number,
                chassis_number,
                pan_number,
                shipping_address,
                flat_number,
                building_name,
                street_name,
                office_state,
                office_district,
                pincode,
                city,
                upload_rc_link,
                upload_pan_card_link,
                upload_aadhaar_voter_dl_passport_link,
                form_created_on,
                total_amount,
                order_id,
                payment_status
            )

            VALUES (
                '".$_POST["form_name"]."',
                '".$_POST["applicant_name"]."',
                '".$_POST["last_name"]."',
                '".$_POST["mobile_number"]."',
                '".$_POST["email_id"]."',
                '".$_POST["mothers_name"]."',
                '".$_POST["date_of_birth"]."',
                '".$_POST["gender"]."',
                '".$_POST["vehicle_registration_number"]."',
                '".$_POST["chassis_number"]."',
                '".$_POST["pan_number"]."',
                '".$_POST["shipping_address"]."',
                '".$_POST["flat_number"]."',
                '".$_POST["building_name"]."',
                '".$_POST["street_name"]."',
                '".$_POST["office_state"]."',
                '".$_POST["office_district"]."',
                '".$_POST["pincode"]."',
                '".$_POST["city"]."',
                '".$upload_rc_link."',
                '".$upload_pan_card_link."',
                '".$upload_aadhaar_voter_dl_passport_link."',
                '".$date."',
                '".$product_price."',
                '".$orderId."',
                '".$payment_status."'
            )";

        if(!$result = $conn->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else {
            $_SESSION["form_id"] = $conn->insert_id;

            $form_name = urlencode($_POST["form_name"]);

            //crm api
            from_to_crm("TOLLTAXES.COM","FSTAG","Fastag Registration",$_POST["applicant_name"],$_POST["mobile_number"],$_POST["email_id"],"Unpaid",(int)$product_price,$_SESSION["form_id"],"Unpaid",$date);
            // cashfree payment
            $secretKey = CASHFREE_KEY_SECRET;
            $postData = array(
                "appId" => CASHFREE_APP_ID,
                "orderId" => $orderId,
                "orderAmount" => $product_price,
                "orderCurrency" => "INR",
                "customerName" => $_POST["applicant_name"],
                "customerPhone" => $_POST["mobile_number"],
                "customerEmail" => $_POST["email_id"],
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

            $sql_update_msme_form = 'UPDATE msme_form SET order_id = "'.$orderId.'" WHERE id = "'.$_SESSION['form_id'].'"';
            $result_update_msme_form = $conn->query($sql_update_msme_form);

            ?>
            <form id="redirectForm" method="post" action="<?php echo REQUEST_URL; ?>">
                <input type="hidden" name="appId" value="<?php echo CASHFREE_APP_ID; ?>"/>
                <input type="hidden" name="orderId" value="<?php echo $orderId; ?>"/>
                <input type="hidden" name="orderAmount" value="<?php echo $product_price; ?>"/>
                <input type="hidden" name="orderCurrency" value="<?php echo "INR"; ?>"/>
                <input type="hidden" name="customerName" value="<?php echo $_POST["applicant_name"]; ?>"/>
                <input type="hidden" name="customerEmail" value="<?php echo $_POST["email_id"]; ?>"/>
                <input type="hidden" name="customerPhone" value="<?php echo $_POST["mobile_number"]; ?>"/>
                <input type="hidden" name="returnUrl" value="<?php echo RETURN_URL; ?>"/>
                <input type="hidden" name="notifyUrl" value="<?php echo NOTIFY_URL; ?>"/>
                <input type="hidden" name="signature" value="<?php echo $signature; ?>"/>
            </form>
            <script>document.getElementById("redirectForm").submit();</script>
            <?php

            // Mailer
            $mail = new PHPMailer(true);

            try {
                 // to user
                $mail->isSMTP();
                $mail->Host       = 'smtp.hostinger.in';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'no-reply@tolltaxes.com';
                $mail->Password   = 'freeDOM@091#';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->setFrom("no-reply@tolltaxes.com", "Fastag Registration");
                $mail->addAddress("".$_POST["email_id"]."");
                $mail->isHTML(true);
                $mail->Subject = "Your Fastag Registration Form Submitted Successfully";
                $mail->Body    = "
                                <body style='color:#000;'>
                                <div style='padding: 15px 0px 25px 0px;text-align:center;'><span style='display: flex;color:#225643;font-size:40px;font-weight:900;'><div style='width: -webkit-fill-available;'><div style=' height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div><div style='white-space: nowrap;'>FASTag Registration</div><div style='width: -webkit-fill-available;'><div style='height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div></span>
                                <span style='color:#000000;font-size:16px;font-weight:900'>Toll Taxes</span>
                                </div>
                                Dear <strong>".ucwords($_POST["applicant_name"])."</strong>,
                                <br><br>
                                Greetings of the day !!
                                <br><br>
                                We glad to know that you apply for FASTag from our website. Your FASTag registration form is submitted Successfully.
                                <br><br>
                                <b>Note: </b>This mail is an acknowledgement of successful submission of your application, on our website. This mail does not confirm the
                                payment status against the submitted application.
                                <br><br>
                                Regards,<br>
                                Team Processing,<br>
                                For Any Enquiry: care@tolltaxes.com
                                <div style='text-align: center;padding: 20px 0px;color: gray;'>
                                  <div style='margin-bottom: 5px;'>Toll Taxes © 2021</div>
                                  <div><a href='https://www.tolltaxes.com/disclaimer.php' style='text-decoration: none;color: gray;'>About</a></div>
                                </div>
                                </body>
                                ";

                $mail->send();

                $mail->ClearAllRecipients();
                //to admin
                $mail->addAddress("admin@tolltaxes.com");
                $mail->isHTML(true);
                $mail->Subject = "Alert! New ".$_POST["form_name"]." Form Submitted";
                $mail->Body    = "
                APPLICANT NAME : ".$_POST["applicant_name"]."<br>
                MOBILE NUMBER  : ".$_POST['mobile_number']."<br>
                EMAIL : ".$_POST['email_id']."
                ";

                $mail->send();
            }
            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
if((isset($_GET['sub1']))&&($_GET['form_id']=="fastag_enquiry")){

if (empty($_GET["applicant_name"])) {
  die("Please Enter Your Name !");
}
if (empty($_GET["mobile_number"])) {
  die("Please Enter Your Mobile Number !");
}
if (empty($_GET["email_id"])) {
  die("Please Enter Your Email !");
}
if (!filter_var($_GET["email_id"], FILTER_VALIDATE_EMAIL)) {
  die("Please Enter Valid Email Address!");
}

$sql=
"
INSERT INTO `fastag_form_enquiry` (
applicant_name,
mobile_number,
email_id,
form_created_on
)

VALUES (
'".$_GET["applicant_name"]."',
'".$_GET["mobile_number"]."',
'".$_GET["email_id"]."',
'".$date."'
)
";

  if(!$result = $conn->query($sql)){
      die('There was an error running the query [' . $conn->error . ']');
  }
  else
  {
    $_SESSION["form_id"] = $conn->insert_id;
    // Mailer
    try {
        //to user
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.in';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'care@tolltaxes.com';
        $mail->Password   = 'freeDOM@091#';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom("care@tolltaxes.com", "Fastag Enquiry");
        $mail->addAddress("".$_GET["email_id"]."");
        $mail->isHTML(true);
        $mail->Subject = "Your Fastag Enquiry Form Submitted Successfully";
        $mail->Body    = "
                        <body style='color:#000;'>
                        <div style='padding: 15px 0px 25px 0px;text-align:center;'><span style='display: flex;color:#225643;font-size:40px;font-weight:900;'><div style='width: -webkit-fill-available;'><div style=' height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div><div style='white-space: nowrap;'>FASTag Enquiry</div><div style='width: -webkit-fill-available;'><div style='height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div></span>
                        <span style='color:#000000;font-size:16px;font-weight:900'>Toll Taxes</span>
                        </div>
                        Dear <strong>".ucwords($_GET["applicant_name"])."</strong>,
                        <br><br>
                        Greetings of the day !!
                        <br><br>
                        We are very sorry to know that you are facing some issues, we assure you that the problem you are facing will be solved with very quickly and will be provided you a better solution.<br><br>
                        We have enhanced our complaint mechanism system. For a quick and better resolution as soon as possible <br><br>
                        Assuring you of best services.
                        <br><br>
                        Regards,<br>
                        Team Processing,<br>
                        For Any Enquiry: care@tolltaxes.com
                        <div style='text-align: center;padding: 20px 0px;color: gray;'>
                          <div style='margin-bottom: 5px;'>Toll Taxes © 2021</div>
                          <div><a href='https://www.tolltaxes.com/disclaimer.php' style='text-decoration: none;color: gray;'>About</a></div>
                        </div>
                        </body>
                        ";

        $mail->send();

        $mail->ClearAllRecipients();
        //to admin
        $mail->addAddress("admin@tolltaxes.com");
        $mail->isHTML(true);
        $mail->Subject = "Alert! New Enquiry Form Submitted On Your tolltaxes.com";
        $mail->Body    = "
        APPLICANT NAME : ".$_GET["applicant_name"]."<br>
        MOBILE NUMBER  : ".$_GET['mobile_number']."<br>
        EMAIL : ".$_GET['email_id']."
        ";

        $mail->send();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
     //crm api
    from_to_crm("TOLLTAXES.COM","ENQUIRY","Fastag Enquiry",$_GET["applicant_name"],$_GET["mobile_number"],$_GET["email_id"],"Unpaid",0,$_SESSION["form_id"],"Unpaid",$date);
    echo "Successfully enquiry form submitted. Our team will contact you shortly";
  }
}
if((isset($_GET['sub1']))&&($_GET['form_id']=="fastag_insted")){

if (empty($_GET["mobile_number"])) {
  die("Please Enter Your Mobile Number !");
}
if (!preg_match('/^[6-9]\d{9}$/', $_GET["mobile_number"])) {
  die("Please Enter Your Correct 10 Digit Mobile Number!");
}
$sql=
"
INSERT INTO `insted_form` (
mobile_number,
form_created_on
)

VALUES (
'".$_GET["mobile_number"]."',
'".$date."'
)
";

  if(!$result = $conn->query($sql)){
      die('There was an error running the query [' . $conn->error . ']');
  }
  else
  {
    $_SESSION["form_id"] = $conn->insert_id;
    // Mailer
    try {
        //to admin
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.in';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'order@tolltaxes.com';
        $mail->Password   = 'freeDOM@091#';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom("order@tolltaxes.com", "Toll Taxes");
        $mail->addAddress("admin@tolltaxes.com");
        $mail->isHTML(true);
        $mail->Subject = "Alert! New Instant Apply Form Submitted On Your tolltaxes.com";
        $mail->Body    = "
        MOBILE NUMBER  : ".$_GET['mobile_number']."<br>
        ";

        $mail->send();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    // crm api
    from_to_crm("TOLLTAXES.COM","INSTANT","Fastag Instant",null,$_GET["mobile_number"],null,"Unpaid",0,$_SESSION["form_id"],"Unpaid",$date);
    echo "Your form has been successfully submitted. Our team will assist you shortly <div> <b>NOTE : </b> We will call you with in 15 minute for further process
</div> ";
  }
}
if((isset($_POST['submit']))&&($_POST['form_name']=="Fastag contact")){

$sql=
"
INSERT INTO `fastag_form_contact` (
applicant_name,
mobile_number,
email_id,
message,
form_created_on
)

VALUES (
'".$_POST["applicant_name"]."',
'".$_POST["mobile_number"]."',
'".$_POST["email_id"]."',
'".$_POST["message"]."',
'".$date."'
)
";

  if(!$result = $conn->query($sql)){
      die('There was an error running the query [' . $conn->error . ']');
  }
  else
  {
    $_SESSION["form_id"] = $conn->insert_id;
    // Mailer
    try {
        //to user
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.in';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'care@tolltaxes.com';
        $mail->Password   = 'freeDOM@091#';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom("care@tolltaxes.com", "FASTag Contact");
        $mail->addAddress($_POST["email_id"]);
        $mail->isHTML(true);
        $mail->Subject = "Your Contact Form Submitted Successfully";
        $mail->Body    = "
                        <body style='color:#000;'>
                        <div style='padding: 15px 0px 25px 0px;text-align:center;'><span style='display: flex;color:#225643;font-size:40px;font-weight:900;'><div style='width: -webkit-fill-available;'><div style=' height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div><div style='white-space: nowrap;'>FASTag Contact</div><div style='width: -webkit-fill-available;'><div style='height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div></span>
                        <span style='color:#000000;font-size:16px;font-weight:900'>Toll Taxes</span>
                        </div>
                        Dear <strong>".ucwords($_POST["applicant_name"])."</strong>,
                        <br><br>
                        Greetings of the day !!
                        <br><br>
                        We are very sorry to know that you are facing some issues, we assure you that the problem you are facing will be solved with very quickly and will be provided you a better solution.<br><br>
                        We have enhanced our complaint mechanism system. For a quick and better resolution as soon as possible <br><br>
                        Assuring you of best services.
                        <br><br>
                        Regards,<br>
                        Team Processing,<br>
                        For Any Enquiry: care@tolltaxes.com
                        <div style='text-align: center;padding: 20px 0px;color: gray;'>
                          <div style='margin-bottom: 5px;'>Toll Taxes © 2021</div>
                          <div><a href='https://www.tolltaxes.com/disclaimer.php' style='text-decoration: none;color: gray;'>About</a></div>
                        </div>
                        </body>
                        ";

        $mail->send();

        $mail->ClearAllRecipients();
        //to admin
        $mail->addAddress("admin@tolltaxes.com");
        $mail->isHTML(true);
        $mail->Subject = "Alert! New ContactUS Form Submitted On Your tolltaxes.com";
        $mail->Body    = "
        APPLICANT NAME : ".$_POST["applicant_name"]."<br>
        MOBILE NUMBER  : ".$_POST['mobile_number']."<br>
        EMAIL : ".$_POST['email_id']."
        MESSAGE : ".$_POST['message']."
        ";

        $mail->send();
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
     //crm api
     from_to_crm("TOLLTAXES.COM","CONTACT","Fastag Contact",$_POST["applicant_name"],$_POST["mobile_number"],$_POST["email_id"],"Unpaid",0,$_SESSION["form_id"],"Unpaid",$date);
    echo "<script>alert('Successfully form submitted. Our team will contact you shortly');window.history.back();</script>";
  }
}



//fastag recharge

if(
    (isset($_POST['form_name'])&& $_POST['form_name'] == 'Fastag Recharge')
)
{
    $_SESSION['table_id'] = 'fastag_form';
    $payment_status = 'Unpaid';
    $product_price = (int)$_POST["recharge_price"];


    $sql="
        INSERT INTO fastag_form (
            form_name,
            applicant_name,
            last_name,
            mobile_number,
            email_id,
            mothers_name,
            date_of_birth,
            gender,
            vehicle_registration_number,
            chassis_number,
            pan_number,
            shipping_address,
            flat_number,
            building_name,
            street_name,
            office_state,
            office_district,
            pincode,
            city,
            upload_rc_link,
            upload_pan_card_link,
            upload_aadhaar_voter_dl_passport_link,
            form_created_on,
            total_amount,
            order_id,
            payment_status,
            fastag_provider

        )

        VALUES (
            '".$_POST["form_name"]."',
            '".$_POST["applicant_name"]."',
            '',
            '".$_POST["mobile_number"]."',
            '".$_POST["email_id"]."',
            '',
            '',
            '',
            '".$_POST["Vehicle_no"]."',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '".$date."',
            '".$product_price."',
            '".$orderId."',
            '".$payment_status."',
            '".$_POST["fastag_pro"]."'
        )";

    if(!$result = $conn->query($sql)){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else {
        $_SESSION["form_id"] = $conn->insert_id;

        $form_name = urlencode($_POST["form_name"]);

        //crm api
        //crm api
            from_to_crm("TOLLTAXES.COM","FSTAG","Fastag Recharge",$_POST["applicant_name"],$_POST["mobile_number"],$_POST["email_id"],"Unpaid",(int)$product_price,$_SESSION["form_id"],"Unpaid",$date);

        // cashfree payment
        $secretKey = CASHFREE_KEY_SECRET;
        $postData = array(
            "appId" => CASHFREE_APP_ID,
            "orderId" => $orderId,
            "orderAmount" => $product_price,
            "orderCurrency" => "INR",
            "customerName" => $_POST["applicant_name"],
            "customerPhone" => $_POST["mobile_number"],
            "customerEmail" => $_POST["email_id"],
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

        $sql_update_msme_form = 'UPDATE msme_form SET order_id = "'.$orderId.'" WHERE id = "'.$_SESSION['form_id'].'"';
        $result_update_msme_form = $conn->query($sql_update_msme_form);

        ?>
        <form id="redirectForm" method="post" action="<?php echo REQUEST_URL; ?>">
            <input type="hidden" name="appId" value="<?php echo CASHFREE_APP_ID; ?>"/>
            <input type="hidden" name="orderId" value="<?php echo $orderId; ?>"/>
            <input type="hidden" name="orderAmount" value="<?php echo $product_price; ?>"/>
            <input type="hidden" name="orderCurrency" value="<?php echo "INR"; ?>"/>
            <input type="hidden" name="customerName" value="<?php echo $_POST["applicant_name"]; ?>"/>
            <input type="hidden" name="customerEmail" value="<?php echo $_POST["email_id"]; ?>"/>
            <input type="hidden" name="customerPhone" value="<?php echo $_POST["mobile_number"]; ?>"/>
            <input type="hidden" name="returnUrl" value="<?php echo RETURN_URL; ?>"/>
            <input type="hidden" name="notifyUrl" value="<?php echo NOTIFY_URL; ?>"/>
            <input type="hidden" name="signature" value="<?php echo $signature; ?>"/>
        </form>
        <script>document.getElementById("redirectForm").submit();</script>
        <?php

        // Mailer
        $mail = new PHPMailer(true);

        try {
             // to user
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.in';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'no-reply@tolltaxes.com';
            $mail->Password   = 'freeDOM@091#';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom("no-reply@tolltaxes.com", "Fastag Recharge");
            $mail->addAddress("".$_POST["email_id"]."");
            $mail->isHTML(true);
            $mail->Subject = "Your Fastag Recharge Form Submitted Successfully";
            $mail->Body    = "
                                <body style='color:#000;'>
                                <div style='padding: 15px 0px 25px 0px;text-align:center;'><span style='display: flex;color:#225643;font-size:40px;font-weight:900;'><div style='width: -webkit-fill-available;'><div style=' height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div><div style='white-space: nowrap;'>FASTag Recharge</div><div style='width: -webkit-fill-available;'><div style='height: calc(50% + 3px);'></div><div style='height: 3px;background: #225643;'></div></div></span>
                                <span style='color:#000000;font-size:16px;font-weight:900'>Toll Taxes</span>
                                </div>
                                Dear <strong>".ucwords($_POST["applicant_name"])."</strong>,
                                <br><br>
                                Greetings of the day !!
                                <br><br>
                                We glad to know that you recharge for FASTag from our website. Your FASTag recharge form is submitted Successfully.
                                <br><br>
                                <b>Note: </b>This mail is an acknowledgement of successful submission of your application, on our website. This mail does not confirm the
                                payment status against the submitted application.
                                <br><br>
                                Regards,<br>
                                Team Processing,<br>
                                For Any Enquiry: care@tolltaxes.com
                                <div style='text-align: center;padding: 20px 0px;color: gray;'>
                                  <div style='margin-bottom: 5px;'>Toll Taxes © 2021</div>
                                  <div><a href='https://www.tolltaxes.com/disclaimer.php' style='text-decoration: none;color: gray;'>About</a></div>
                                </div>
                                </body>
                                ";

            $mail->send();

            $mail->ClearAllRecipients();
            //to admin
            $mail->addAddress("admin@tolltaxes.com");
            $mail->isHTML(true);
            $mail->Subject = "Alert! New ".$_POST["form_name"]." Form Submitted";
            $mail->Body    = "
            APPLICANT NAME : ".$_POST["applicant_name"]."<br>
            MOBILE NUMBER  : ".$_POST['mobile_number']."<br>
            EMAIL : ".$_POST['email_id']."
            ";

            $mail->send();
        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}







   ?>
<!-- Event snippet for Submit lead form conversion page -->
<script> gtag('event', 'conversion', {'send_to': 'AW-459751082/b0gUCLyewu4BEKr9nNsB'}); </script>
