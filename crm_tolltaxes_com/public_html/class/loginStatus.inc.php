<?php
function login_status($conn,$redirect = true){
  if((isset($_COOKIE["username"]))&&(isset($_COOKIE["mdh5_pass"]))) {
    $sql = "SELECT `id`, `name`, `mdh5_pass`,`username`,`img` FROM `users` WHERE `username` = '".$_COOKIE["username"]."' and `mdh5_pass` = '".$_COOKIE["mdh5_pass"]."'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      while($row = $result->fetch_assoc()) {
        return ["id" => $row["id"], "name" => $row["name"],"username" => $row["username"],"mdh5_pass" => $row["mdh5_pass"],"user_img" => $row["img"]];
      }
    } else {
      if($redirect == true){
        header("Location: login.php");
      } else {
        return false;
      }
    }
  } else {
    if($redirect == true){
      header("Location: login.php");
    } else {
      return false;
    }
  }
}
 ?>
