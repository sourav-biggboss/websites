<?php
//website mail name
$web_setFrom = "Udyam OTP";
//subject of otp mail
$web_Subject = 'OTP Verification for Confirmation of '.$form_name;
//body of otp mail 
$web_Body = '
<body>
<div style="border-radius: 6px;color: #000;">
    <div style="  padding: 0px 87px;   border-bottom: 2px solid #ddd;  text-align: center;"><img src="https://registrationmsme.com/assets/img/Udyam-registration-logo.png" class="mahatma-logo" alt="mahtma-gandhi-logo" title="logo"></div>
    <div style="  padding: 10px; text-align: left;"><p>
    <h1>OTP Verification for Confirmation of '.$form_name.'</h1>
Dear <strong>'.$mail_applicant_name.'</strong>,
<br><br>
Greetings of the day !!
<br><br>
This is to inform you that the OTP (One Time Password) has been sent to your registered mobile number regarding your slot booking for the '.$form_name.'.
Please enter it below for verification. Do not share it with anyone.
<br><br>
<a href="https://'.$web.'/otp-from.php?id='.$row['id'].'" style="text-decoration: none;"><button style="border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;background-color: #FF4500"> OTP </button></a>
    <br><br>
        <span>Regards</span><br>
        <span>Team Processing</span>
        For Order Status: order@'.$host_name.'<br>
          <div style="margin-bottom: 5px;">MSME Registration © 2022</div>
  <div><a href="https://registrationmsme.com/about-us.php" style="text-decoration: none;color: gray;">About</a></div>
</div>
        <span>Note : Do not reply to this email as this is an unattended email.</span>
        
    </div>
</body>';

?>