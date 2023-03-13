<?php
function login_user($username,$password,$conn){

  $sql = "SELECT `id`,`roll_type_id`, `name`, `mdh5_pass`,`username` FROM `users` WHERE `username` = '$username' and `password` = '$password'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
        
        
    $sql_roll_type = "SELECT * FROM `roll_types` WHERE id = '".$row['roll_type_id']."'";
    $result_roll_type = $conn->query($sql_roll_type);
    if ($result_roll_type->num_rows == 1) {
    $row_roll_type = $result_roll_type->fetch_assoc(); 
    }

        
        
      setcookie("username", $row["username"], time() + (86400 * 30), "/");
      setcookie("roll_type", $row_roll_type["roll"], time() + (86400 * 30), "/");
      setcookie("mdh5_pass", $row["mdh5_pass"], time() + (86400 * 30), "/");
      return true;
    }
  } else {
    return false;
  }

}
 ?>
