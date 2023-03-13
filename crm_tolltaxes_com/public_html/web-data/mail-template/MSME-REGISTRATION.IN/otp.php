<?php
//website mail name
$web_setFrom = "MSME OTP";
//subject of otp mail
$web_Subject = 'OTP Verification for Confirmation of '.$form_name;
//body of otp mail 
$web_Body = 
    '
    <section style="width:100%;background-color: ; padding: 10px;font-family: \'Poppins\', sans-serif;">
    <div style="display: flex;align-items: center;"><div><img src="http://msme-registration.in/assets/image/udyam-logo-png.png" style="
    width: 105px;
    "></div><div style="
    align-items: center;
    "><p style="font-size: 31px;font-weight: 700;">OTP Verification for Confirmation of '.$form_name.'</p></div></div>
    <hr style="margin-top: 20px;margin-bottom: 20px;">
    <span>Dear '.$mail_applicant_name.',</span><br><br>
    <span>Greeting of the Day</span><br><br>
    
    <div id="container" style="background-color: #7cfcb9; padding: 40px ; border-radius: 10px; margin: 10px 0px 20px 0px;">
        This is to inform you that the OTP (One Time Password) has been sent to your registered mobile number regarding your slot booking for the '.$form_name.'.
        Please enter it below for verification. Do not share it with anyone.
    <br>
    <a href="https://'.$web.'/otp-from.php?id='.$row['id'].'" style="background: #1b61a5;border-radius: 8px;color:#ffffff;text-decoration:none;padding:10px;margin-top:20px;display:inline-flex;">OTP</a>
    <br><br>
    </div>
    <span>Regards</span><br>
    <span>Team Processing</span><br>
    <span>Mail Us: <a href="mailto:care@msme-registration.in">care@msme-registration.in</a></span><br>
    For Order Status: <a href="https://msme-registration.in/track-order.php">Click here<a><br>
    For Complaint: <a href="https://msme-registration.in/complaint-order.php">Click here<a><br>
    
        <div style="text-align: center;padding: 20px 0px;color: gray;">
  <div style="margin-bottom: 5px;">MSME Registration © 2022</div>
  <div><a href="https://msme-registration.in/about-us.php" style="text-decoration: none;color: gray;">About</a></div>
</div>
    <span>Note : Do not reply to this email as this is an unattended email.</span>
    </section>
    ';

?>