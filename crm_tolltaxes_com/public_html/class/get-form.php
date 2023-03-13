<?php
function get_form_num($web = "ALL",$status = "ALL",$track_status = "ALL",$conn){
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
  if($track_status != "ALL"){$insid_sql.=" and `track_status` = '$track_status'";}
  if(($_COOKIE['roll_type'] == "SALE" || $_COOKIE['roll_type'] == "PROCESSER") && isset($user_id)){$insid_sql.=" and ( `processor_id` = '$user_id'  OR  `sales_id` = '$user_id' )";}
  $sql = "SELECT * FROM `forms` WHERE  $insid_sql";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result->num_rows;
  } else {
    return 0;
  }
}
function get_form_data_num($web = "ALL",$status = "ALL",$track_status = "ALL",$from_limit = "0",$to_limit = "30",$track_stages_id = "ALL",$conn,$search_query){
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
  if($track_stages_id != "ALL"){$insid_sql.=" and `track_stage_id` = '$track_stages_id'";}
  if($track_status != "ALL"){$insid_sql.=" and `track_status` = '$track_status'";}
  if(($_COOKIE['roll_type'] == "SALE" || $_COOKIE['roll_type'] == "PROCESSER") && isset($user_id)){$insid_sql.=" and ( `processor_id` = '$user_id'  OR  `sales_id` = '$user_id' )";}
  if($search_query != "ALL"){$insid_sql ="`number` = '$search_query' or `email` = '$search_query' or `order_id` = '$search_query'";}
  $sql = "SELECT * FROM `forms` WHERE  $insid_sql  ORDER BY `id` DESC LIMIT $from_limit , $to_limit";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result;
  } else {
    return 0;
  }
}
function get_form_data_num_filter($web = "ALL",$status = "ALL",$track_status = "ALL",$stage = "ALL",$price = "ALL",$orderby = "ALL",$assign = "ALL",$fromdate = "ALL",$todate = "ALL",$from_limit = "0",$to_limit = "30",$conn,$search_query){
  $insid_sql = "`id` != '0'";
  if($web != "ALL"){$insid_sql.=" and `web` in ('".$web."')";}
  if($status != "ALL"){$insid_sql.=" and `status` = '$status'";}
  if($track_status != "ALL"){$insid_sql.=" and `track_status` = '$track_status'";}
  if($stage != "ALL"){$insid_sql.=" and `track_stage_id` = '$stage'";}
  if($price != "ALL"){$insid_sql.=" and `price` = '$price'";}
  if($orderby != "ALL"){$ordersql = "ORDER BY id ".$orderby;}else{$ordersql = "";}
  if($assign != "ALL"){$insid_sql.=" and (`sales_id` = '$assign' OR `processor_id` = '$assign')";}
  if($todate != "ALL" && $todate != "" && $fromdate != "ALL" && $fromdate != "" && isset($fromdate) && isset($todate)){$insid_sql.=" and form_date between '".$fromdate." 00:00:00' AND '".$todate." 00:00:00'";}
  $sql = "SELECT * FROM `forms` WHERE  $insid_sql  ".$ordersql." LIMIT $from_limit , $to_limit ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    return $result;
  } else {
    return 0;
  }
}

function UserAssignForm($user_id,$conn){
    $sql_user = "SELECT `id`,`roll_type_id`,`name`,`username` FROM `users` WHERE `id` = '".$user_id."'";
    $result_user = $conn->query($sql_user);
    if ($result_user->num_rows == 1) {
      $row_user = $result_user->fetch_assoc();
      return $row_user['name'];
    } else {
      return "-";
    }
}
 ?>
