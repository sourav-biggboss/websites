<?php
require_once('lib/mail/PHPMailerAutoload.php');
require_once('lib/mail/credential.php');
$mail_from = mysqli_real_escape_string($conn, $_POST['mail_from']);

$sql_track = "UPDATE `forms` SET `tracking_details` = ( SELECT `mail_dropdown_type` FROM `all_mail`  WHERE `id` = '".mysqli_real_escape_string($conn,$_POST['mail_type'])."' LIMIT 1) WHERE  `id` ='".$id."'";
$conn->query($sql_track);

$sql = "SELECT * FROM `mail_config` WHERE `mail` = '$mail_from'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
    try {
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $row["host"];
        $mail->SMTPAuth   = true;
        $mail->Username   = $mail_from;
        $mail->Password   = $row["pass"];
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom($mail_from, $row["website_name"]);
        $mail->addAddress($_POST['mail_to']);
        $mail->isHTML(true);
        $mail->Subject =  $_POST['mail_sbj'];
        $mail->Body    = $_POST['mail_msg'];

        foreach ($_FILES["mail_file"]["name"] as $k => $v) {
            $mail->AddAttachment( $_FILES["mail_file"]["tmp_name"][$k], $_FILES["mail_file"]["name"][$k] );
        }

        $mail->send();
    }
    catch (Exception $e) {
      include("views/mail-to-client-alert.html.php");
    }
  include("views/mail-to-client-success.html.php");
  }
}else{
  include("views/mail-to-client-alert.html.php");
}
?>
