<?php
//website mail name
$web_setFrom = "Udyam Payment Due";
//subject of payment mail
$web_Subject = 'Payment Confirmation for '.$form_name;
//body of payment mail 
$web_Body = '
<body>
<div style="border-radius: 6px;color: #000;">
    <div style="  padding: 0px 87px;   border-bottom: 2px solid #ddd;  text-align: center;"><img src="https://registrationmsme.com/assets/img/Udyam-registration-logo.png" class="mahatma-logo" alt="mahtma-gandhi-logo" title="logo"></div>
    <div style="  padding: 10px; text-align: left;"><p>
    <h1>Payment Confirmation for '.$form_name.'</h1>
Dear <strong>'.$mail_applicant_name.'</strong>,
<br><br>
Greetings of the day !!
<br><br>
We get to know that you apply for Udyam Certificate our website. This informs you of an outstanding payment for your Udyam registration. We value you as a customer and we would not like to lose you but we have not received your payment yet, please make your payment to continue further processing.
<br><br>
<table>
                    <tbody>
                    <tr><th colspan="4" style="padding:10px;background-color:#1d1a6a;font-weight:bold;color:#fff;font-weight:bold">Your Udyam Registration Details</th></tr>
                    <tr><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">NAME : </td><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">'.strtoupper($applicant_name).'</td></tr>
                    <tr><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">EMAIL : </td><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold"><a style="text-decoration:none;color:#000">'.strtoupper($user_email_id).'</a></td></tr>
                    <tr><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">NUMBER : </td><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">'.strtoupper($mobile_number).'</td></tr>
                    <tr><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">AMOUNT PAYABLE: </td><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">'.strtoupper($price_form).'</td></tr>
                    <tr><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">PAYMENT STATUS: </td><td style="padding:10px;font-weight:bold;background-color:#ddd;font-weight:bold">UNPAID</td></tr>
                    </tbody>
                    </table>
<br><br>
Click below button for Payment<br><br>
  <a href="https://'.$web.'/late-pay.php?id='.$row['id'].'&table='.$table_name.'"><input style="border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;background-color: #1d1a6a;" type="button" name="submit" value="PAY"></a>
<br><br>
Regards,<br>
Team Processing,<br>
For Any Enquiry: info@registrationmsme.com
<div style="text-align: center;padding: 20px 0px;color: gray;">
  <div style="margin-bottom: 5px;">Registration MSME © 2022</div>
  <div><a href="https://www.registrationmsme.com" style="text-decoration: none;color: gray;">About</a></div>
    </div></div>
</body>';
?>