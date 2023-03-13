<?php
//website mail name
$web_setFrom = "FASTag OTP";
//subject of otp mail
$web_Subject = 'OTP Verification for Slot Confirmation of '.$form_name;
//body of otp mail 
$web_Body = '<body style="color:#000;">
<div style="padding: 15px 0px 25px 0px;text-align:center;"><span style="display: flex;color:#225643;font-size:40px;font-weight:900;"><div style="width: -webkit-fill-available;"><div style=" height: calc(50% + 3px);"></div><div style="height: 3px;background: #225643;"></div></div><div style="white-space: nowrap;">FASTag OTP</div><div style="width: -webkit-fill-available;"><div style="height: calc(50% + 3px);"></div><div style="height: 3px;background: #225643;"></div></div></span>
<span style="color:#000000;font-size:16px;font-weight:900">Toll Taxes</span>
</div>
Dear <strong>'.$mail_applicant_name.'</strong>,
<br><br>
Greetings of the day !!
<br><br>
This is to inform you that the OTP (One Time Password) has been sent to your registered mobile number regarding your slot booking for the '.$form_name.'.
Please enter it below for verification. Do not share it with anyone.
<br><br>
<a href="https://'.$web.'/otp-from.php?id='.$row['id'].'" style="text-decoration: none;"><button style="border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;background-color: #FF4500"> OTP </button></a>
    <br><br>
    Regards,<br>
    Team Processing,<br>
    For Any Enquiry: care@tolltaxes.com
    <div style="text-align: center;padding: 20px 0px;color: gray;">
      <div style="margin-bottom: 5px;">Toll Taxes © 2021</div>
      <div><a href="https://www.tolltaxes.com/disclaimer.php" style="text-decoration: none;color: gray;">About</a></div>
    </div>
    </body>';

?>