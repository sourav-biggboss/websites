<?php
//website mail name
$web_setFrom = "GEM OTP";
//subject of otp mail
$web_Subject = 'OTP Verification for Confirmation of '.$form_name;
//body of otp mail
$web_Body =
    '
    <section style="width:100%;background-color: ;font-family: \'Poppins\', sans-serif;">
      <div style="background-color:#385067;align-items: center;text-align:center; padding:20px 8px;color:#fff;border-bottom:10px solid #b33030;"><div style="font-size: 31px;font-weight: 700;">OTP Verification for Confirmation of '.$form_name.'</div></div>
      <br>
    <span>Dear '.$mail_applicant_name.',</span><br><br>
    <span>Greeting of the Day</span><br><br>

   <div id="container" style="border:2px solid #ddd; padding: 20px ;  margin: 10px 0px 20px 0px;font-weight:600;">
      This is to inform you that the OTP (One Time Password) has been sent to your registered mobile number regarding your slot booking for the '.$form_name.'.
      Please enter it below for verification. Do not share it with anyone.
      <br>
      <center><a href="https://'.$web.'/otp-from.php?id='.$row['id'].'" style="background: #385067;color:#ffffff;text-decoration:none;padding:10px;margin-top:20px;display:inline-flex;">OTP</a></center>
      <br><br>
    </div>
    <span>Regards</span><br>
    <span>Team Processing</span><br>
    <span>Mail Us: <a href="mailto:care@gemregistrar.com">care@gemregistrar.com</a></span><br>
    For Order Status: <a href="https://gemregistrar.com/track-order.php">Click here<a><br>
        For Complaint: <a href="https://gemregistrar.com/complaint-order.php">Click here<a><br>

            <div style="text-align: center;padding: 20px 0px;color: gray;">
              <div style="margin-bottom: 5px;">GEM Registration © 2022</div>
              <div><a href="https://gemregistrar.com/about-us.php" style="text-decoration: none;color: gray;">About</a></div>
            </div>
            <span>Note : Do not reply to this email as this is an unattended email.</span>
  </section>
    ';

?>
