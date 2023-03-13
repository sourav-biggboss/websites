<?php
    require("./config.php");
    date_default_timezone_set('Asia/Kolkata'); 
    $date=date('d-m-Y H:i:s');

    $form_created_on_date = date('d-m-Y');
    $form_created_on_time = date('H:i:s');
  
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './vendor/autoload.php';

    $applicant_name   = urlencode($_POST['applicant_name']);
    $mobile_number    = urlencode($_POST['mobile_number']);
    $email_id         = urlencode($_POST['email_id']);

    if(isset($_POST["submit"])) {
        $complaint_id = 'CMP-2020-'.(rand(100000000,999999999));
        $message = urlencode($_POST["complaint_details"]);

        $sql="
        INSERT INTO complaint_forms (
            complaint_id,
            form_name,
            applicant_name,
            mobile_number,
            email_id,
            order_id,
            transaction_date,
            transaction_amount,
            complaint_details,
            form_created_date
        )

        VALUES (
            '".$complaint_id."',
            'Complaint Form',
            '".$_POST["applicant_name"]."',
            '".$_POST["mobile_number"]."',
            '".$_POST["email_id"]."',
            '".$_POST["order_id"]."',
            '".$_POST["transaction_date"]."',
            '".$_POST["transaction_amount"]."',
            '".$message."',
            '".$date."'
        )";

        if(!$result = $conn->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else {

            $sql =
            "
            INSERT INTO complaint_timeline (
                meta_id,
                meta_name,
                meta_description,
                meta_user,
                meta_type,
                form_created_on,
                form_created_time
            )

            VALUES (
                '".$complaint_id."',
                'complaint form',
                '".$message."',
                '".$_POST["applicant_name"]."',
                'out',
                '".$form_created_on_date."',
                '".$form_created_on_time."'
            )
            ";
            $result = $conn->query($sql);
            
            if ($result) {                
                $post = [
                    'complaint_id'       => $complaint_id,
                    'form_name'          => 'Complaint Form',
                    'applicant_name'     => $_POST["applicant_name"],
                    'mobile_number'      => $_POST["mobile_number"],
                    'email_id'           => $_POST["email_id"],
                    'order_id'           => $_POST["order_id"],
                    'transaction_date'   => $_POST["transaction_date"],
                    'transaction_amount' => $_POST["transaction_amount"],
                    'complaint_details'  => $message,
                    // 'website'            => 'UDYOGADHARCERTIFICATE.IN'
                    'website'            => strtoupper($_SERVER['SERVER_NAME'])
                ];

            if ($_SERVER['HTTP_HOST'] == 'localhost') {
                    $ch = curl_init('http://localhost/crm.techlounge.co.in/api/complaint-new.php');
        }   else {
                    $ch = curl_init('https://crm.techlounge.co.in/api/complaint-new.php');
        }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    $response = curl_exec($ch);
                    curl_close($ch);


                    $post = [
                        'business'           => 'MSME',
                        'complaint_id'       => $complaint_id,
                        'form_name'          => 'Complaint Form',
                        'applicant_name'     => $_POST["applicant_name"],
                        'mobile_number'      => $_POST["mobile_number"],
                        'email_id'           => $_POST["email_id"],
                        'order_id'           => $_POST["order_id"],
                        'transaction_date'   => $_POST["transaction_date"],
                        'transaction_amount' => $_POST["transaction_amount"],
                        'complaint_details'  => $message,
                        // 'website'            => 'UDYOGADHARCERTIFICATE.IN'
                        'website'            => strtoupper($_SERVER['SERVER_NAME'])
                ];

            if ($_SERVER['HTTP_HOST'] == 'localhost') {
                    $ch = curl_init('http://localhost/crm2.techlounge.co.in/api/complaint-new.php');
                } else {
                    $ch = curl_init('https://crm2.techlounge.co.in/api/complaint-new.php');
                }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);
                // echo $response;

                header ('location: ./complaint-success.php?complaint_id='.$complaint_id.'');
            }
        }
    }
?>
