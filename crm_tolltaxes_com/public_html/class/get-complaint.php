<?php
function get_complaint_data_num($web = "ALL",$status = "ALL",$track_status = "ALL",$from_limit = "0",$to_limit = "30",$conn){
  if($_COOKIE['roll_type'] == "SALE" || $_COOKIE['roll_type'] == "PROCESSER"){
    $sql_user = "SELECT `id`,`roll_type_id`,`username` FROM `users` WHERE `username` = '".$_COOKIE['username']."'";
    $result_user = $conn->query($sql_user);
    if ($result_user->num_rows == 1) {
      $row_user = $result_user->fetch_assoc(); $user_id =  $row_user['id'];
    } else {
      die('comman user');
    }
  }

  $insid_sql = "`id` != '0'";
  if($web != "ALL"){$insid_sql.=" and `web` in ($web)";}
  if($status != "ALL"){$insid_sql.=" and `status` = '$status'";}
  if(($_COOKIE['roll_type'] == "SALE" || $_COOKIE['roll_type'] == "PROCESSER") && isset($user_id)){$insid_sql.=" and ( `processor_id` = '$user_id'  OR  `sales_id` = '$user_id' )";}
  if($track_status != "ALL"){$insid_sql.=" and `track_status` = '$track_status'";}
//   $sql = "SELECT * FROM `forms` WHERE  $insid_sql  ORDER BY `id` DESC LIMIT $from_limit , $to_limit";
     $sql = "SELECT forms.*,MAX(message.id) as complaint_id FROM forms LEFT JOIN message ON forms.number = message.mobile WHERE message.type='complaint' GROUP BY message.mobile ORDER BY complaint_id DESC LIMIT $from_limit , $to_limit";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result;
  } else {
    return 0;
  }
}
?>
