<?php

require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/config/db.php");
$forms_data = mysqli_query($conn,"DELETE FROM `forms` WHERE `status` = 'Unpaid' AND (
  `email` in('kfsdeveloper7@gmail.com','dhananjaykarn864@gmail.com','souravmaity091@gmail.com','ajitkumae23@gmail.com','riteshkumarsharma292@gmail.com','test@gmail.com','dummy@gmail.com')
   or `name` in('dummy','test')
   or `number` in('1234567890','1111111111','2222222222','3333333333','4444444444','5555555555','6666666666','7777777777','8888888888','9999999999','0000000000','9876543210')
 ) ");
if($forms_data){
    echo 'flushed-forms:'.mysqli_num_rows($forms_data);
}
mysqli_query($conn,"DELETE FROM `forms` WHERE `status` = 'Unpaid' AND `email` = '' AND `number` = ''");
mysqli_query($conn,"DELETE FROM `forms` WHERE 
  `email` in('kfsdeveloper7@gmail.com','dhananjaykarn864@gmail.com','souravmaity091@gmail.com','ajitkumae23@gmail.com','riteshkumarsharma292@gmail.com','test@gmail.com','dummy@gmail.com'");
?>
