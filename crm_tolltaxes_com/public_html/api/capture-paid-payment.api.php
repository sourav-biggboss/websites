<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $web = $_GET['website'];
} else {
    $web = strtoupper($_SERVER['SERVER_NAME']);
}

if((isset($_GET['form_id'])) && ($_GET['form_id'] != '')){
    $form_id = $_GET['form_id'];
} else {
   die();
}
require_once("../config/db.php");
$sql_assign = "SELECT users.id as user_id,users.username, (SELECT COUNT(forms.processor_id) FROM forms WHERE forms.processor_id = users.id GROUP BY forms.processor_id HAVING forms.processor_id = users.id) as number_of_asaign FROM `users` WHERE users.roll_type_id in(SELECT roll_types.id FROM roll_types WHERE roll_types.roll = 'PROCESSER') ORDER BY number_of_asaign ASC LIMIT 1;";
$result_assign = $conn->query($sql_assign);

if ($result_assign->num_rows > 0) {
  while($row_assign = $result_assign->fetch_assoc()) {
     $assign_id = $row_assign["user_id"];
  }
} else{
  $assign_id = 0;
}

$sql = "UPDATE `forms` SET `status`='Paid', `processor_id` = '".$assign_id."', `track_status` = 'Process' WHERE `web` = '$web' AND `form_id`= $form_id";
$conn->query("UPDATE `forms` SET `track_status`='Process'  WHERE `web` = '$web' AND `form_id`= $form_id");
$conn->query("UPDATE `forms` SET `tracking_details`='Processing'  WHERE `web` = '$web' AND `form_id`= $form_id");
if ($conn->query($sql) === TRUE) {
echo $conn->insert_id;
} else {
echo false;
}


?>
