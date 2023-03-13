<?php 
if ((empty($_POST["account_id"])) || ($_POST["account_id"] == "") || (empty($_POST["event"])) || ($_POST["event"] == "") || (empty($_POST["order_id"])) || ($_POST["order_id"] == "") || (empty($_POST["payment_id"])) || ($_POST["payment_id"] == "") || (empty($_POST["amount"])) || ($_POST["amount"] == "") || (empty($_POST["email"])) || ($_POST["email"] == "") || (empty($_POST["mobile"])) ||($_POST["mobile"] == ""))
{
  die('Incorrect Details');
}
require_once("../config/db.php");
date_default_timezone_set('Asia/Kolkata');

$merchant_id = $_POST["account_id"];
$event = $_POST["event"];
$order_id = $_POST["order_id"];
$payment_id = $_POST["payment_id"];
$amount = $_POST["amount"];
$amount = $amount + 0;
$email = $_POST["email"];
$mobile = $_POST["mobile"];
if ($event === 'Success') {
      $sql_assign = "SELECT users.id as user_id,users.username, (SELECT COUNT(forms.processor_id) FROM forms WHERE forms.processor_id = users.id GROUP BY forms.processor_id HAVING forms.processor_id = users.id) as number_of_asaign FROM `users` WHERE users.roll_type_id in(SELECT roll_types.id FROM roll_types WHERE roll_types.roll = 'PROCESSER') ORDER BY number_of_asaign ASC LIMIT 1;";
    $result_assign = $conn->query($sql_assign);

    if ($result_assign->num_rows > 0) {
      while($row_assign = $result_assign->fetch_assoc()) {
         $assign_id = $row_assign["user_id"];
      }
    } else{
        $assign_id = 0;
    }
  $conn->query("INSERT INTO `payment_list`(`email`, `price`, `payment_id`, `number`, `merchent_id`) VALUES ('".$email."','".$amount."','".$payment_id."','".$mobile."','".$merchant_id."')");
  $sql = "UPDATE `forms` SET `status`='Paid',`price` = '".$amount."',`track_status` = 'Process',`processor_id` = '".$assign_id."' ,`payment_id` = '".$payment_id."' WHERE `order_id` = '".$order_id."'";

  if ($conn->query($sql) === TRUE) {
    return true;
  } else {
    return false;
  }

}else{
  $sql = "UPDATE `forms` SET `payment_status_check`='Failed' WHERE `order_id` = '".$order_id."'";
  $conn->query($sql);
}
 ?>