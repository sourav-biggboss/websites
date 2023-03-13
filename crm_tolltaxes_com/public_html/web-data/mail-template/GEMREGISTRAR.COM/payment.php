<?php
//website mail name
$web_setFrom = "GEM Payment Due";
//subject of payment mail
$web_Subject = 'Payment Confirmation for '.$form_name;
//body of payment mail
$web_Body =
    '
    <section style="width:100%;background-color: ;font-family: \'Poppins\', sans-serif;">
  <div style="background-color:#385067;align-items: center;text-align:center; padding:20px 8px;color:#fff;border-bottom:10px solid #b33030;"><div style="font-size: 31px;font-weight: 700;">GEM Payment</div></div>
  <br>
<span>Dear '.$mail_applicant_name.',</span><br><br>
<span>Greeting of the Day</span><br><br>

<div id="container" style="border:2px solid #ddd; padding: 20px ;  margin: 10px 0px 20px 0px;font-weight:600;">
  <h4>We get to know that you apply for GEM Registration our website. This informs you of an outstanding payment for your GEM registration. We value you as a customer and we would not like to lose you but we have not received your payment yet,
    please make your payment to continue further processing.</h4>

  <table style="  border-collapse: collapse;">
    <tbody>
      <tr style="border-bottom: 1px solid #fff;">
        <td style="padding: 8px;">NAME: </td>
        <td style="padding: 8px;">'.strtoupper($applicant_name).'</td>
      </tr>
      <tr style="border-bottom: 1px solid #fff;">
        <td style="padding: 8px;">EMAIL: </td>
        <td style="padding: 8px;">'.strtoupper($user_email_id).'</td>
      </tr>
      <tr style="border-bottom: 1px solid #fff;">
        <td style="padding: 8px;">NUMBER: </td>
        <td style="padding: 8px;">'.strtoupper($mobile_number).'</td>
      </tr>
      <tr style="border-bottom: 1px solid #fff;">
        <td style="padding: 8px;">AMOUNT PAYABLE: </td>
        <td style="padding: 8px;">'.strtoupper($price_form).'</td>
      </tr>
      <tr style="border-bottom: 1px solid #fff;">
        <td style="padding: 8px;">PAYMENT STATUS: </td>
        <td style="padding: 8px;">UNPAID</td>
      </tr>
    </tbody>
  </table>
  <br><br>
  Click below button for Payment<br>
  <center><a href="https://'.$web.'/late-pay.php?id='.$row['id'].'&table='.$table_name.'" style="background: #385067;color:#ffffff;text-decoration:none;padding:10px;margin-top:20px;display:inline-flex;">PAY</a></center>
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
