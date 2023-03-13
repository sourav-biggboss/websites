<?php
    require("./config.php");
    date_default_timezone_set('Asia/Kolkata'); 
    $date=date('d-m-Y H:i:s');

    $form_created_on_date = date('d-m-Y');
    $form_created_on_time = date('H:i:s');
  
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './vendor/autoload.php';

    if(($_POST["complaint_id"] != '')) {
        $sql_select_form = 'SELECT * FROM complaint_forms WHERE complaint_id = "'.$_POST["complaint_id"].'"';
        $result_select_form = $conn->query($sql_select_form);
        if ($result_select_form->num_rows == 1) {
            $row_select_form = $result_select_form->fetch_assoc();
            $meta_user = $row_select_form['applicant_name'];
            $message = urlencode($_POST["message"]);
        }

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
            '".$_POST["complaint_id"]."',
            'complaint form',
            '".$message."',
            '".$meta_user."',
            'out',
            '$form_created_on_date',
            '$form_created_on_time'
        )
        ";

        if(!$result = $conn->query($sql)){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else {
            $post = [
                'complaint_id' => $_POST["complaint_id"],
                'message'   => $message
            ];

        if  ($_SERVER['HTTP_HOST'] == 'localhost') {
                $ch = curl_init('http://localhost/crm.techlounge.co.in/api/complaint-re.php');
        } else {
                $ch = curl_init('https://crm.techlounge.co.in/api/complaint-re.php');
        }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response = curl_exec($ch);
                curl_close($ch);
                echo $response;

            if ($_SERVER['HTTP_HOST'] == 'localhost') {
                $ch = curl_init('http://localhost/crm2.techlounge.co.in/api/complaint-re.php');
            } else {
                $ch = curl_init('https://crm2.techlounge.co.in/api/complaint-re.php');
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }
    }
?>
