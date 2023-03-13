<?php
//website mail name
$web_setFrom = "Your MSME Registration On Hold";
//subject of otp mail
$web_Subject = 'Hury Up ! MSME Registration Will Expire Soon';
//body of otp mail 
$web_Body = 
    '
<section style="background-color: ; padding: 10px;font-family: \'Poppins\', sans-serif;">
    <div style="display: flex;align-items: center;"><div><img src="http://msme-registration.in/assets/image/udyam-logo-png.png" style="
    width: 105px;
    "></div><div style="align-items: center;text-align: center;"><p style="font-size: 31px;font-weight: 700;text-align: center;">MSME Registration</p></div></div>
    <hr style="margin-top: 20px;margin-bottom: 20px;">
    <span>Dear '.$mail_applicant_name.',</span><br><br>
    <span>Greeting of the Day</span><br><br>
        <center><img src="https://msme-registration.in/assets/img/image-hurry.jpg" width="150px"/></center>
    <div id="container" style="background-color: #f8f8f8; padding: 20px ; border-radius: 10px; margin: 10px 0px 20px 0px;font-weight:600;">
    <div>
This mail is in reference to the MSME / UDYAM REGISTRATION Submitted by you.
<br><br>
<div style="color:orange;">UDYAM REGISTRATION IS ON HOLD !!</div>
<br>
We request you to complete the payment at the earliest to enable us to process your application.
<br>
</div>
<div style="margin-top:20px;background-color:#04aa6d;">
<a href="'.$campaign_link.'" style="text-align:center;text-decoration:none;background-color:#04aa6d;color:#fff;border-radius:4px; padding:10px;font-weight:800;display:block;" >Pay Here</a>
</div>

    <br>
   
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