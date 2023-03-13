<?php
//website mail name
$web_setFrom = "GEM Registration OFFER";
//subject of otp mail
$web_Subject = 'Hury Up ! GEM Registration For Free Only Delivery Charge While Added';
//body of otp mail
$web_Body =
    '
    <section style="width:100%;background-color: ;font-family: \'Poppins\', sans-serif;">
      <div style="background-color:#385067;align-items: center;text-align:center; padding:20px 8px;color:#fff;border-bottom:10px solid #b33030;"><div style="font-size: 31px;font-weight: 700;">GEM Registration
      </div></div>
      <br>
    <span>Dear '.$mail_applicant_name.',</span><br><br>
    <span>Greeting of the Day</span><br><br>
    <center><img src="https://gemregistrar.com/assets/img/3-2-special-offer-png-images.png" width="150px" /></center>
    <div id="container" style="border:2px solid #ddd; padding: 20px ;  margin: 10px 0px 20px 0px;font-weight:600;">
      <div>
      '.$campain_text.'
        <br><br>
        This mail is in reference to the GEM REGISTRATION Submitted by you.
        <br><br>
        <div style="color:#b33030;">GEM REGISTRATION IS ON OFFER !!</div>
        <br>
        We request you to complete the payment at the earliest to enable us to process your application.
        <br>
      </div>
      <div style="margin-top:20px;background-color:#04aa6d;">
        <a href="https://'.$host_name.'/mine-form.php?id='.$applicant_id.'" style="text-align:center;text-decoration:none;background-color:#385067;color:#fff;border-radius:4px; padding:10px;font-weight:800;display:block;">Pay Here</a>
      </div>

      <br>

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
