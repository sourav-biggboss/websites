<?php
function logout_user($conn,$redirect = true){
  if((isset($_COOKIE["username"]))&&(isset($_COOKIE["mdh5_pass"]))) {
    unset($_COOKIE["username"]);
    unset($_COOKIE["mdh5_pass"]);
    unset($_COOKIE["roll_type"]);

    setcookie("username", "", 0, "/");
    setcookie("mdh5_pass", "", 0, "/");
    setcookie("roll_type", "", 0, "/");

    if($redirect === true){
      header("Location: ../login.php");
    } else {
      return false;
    }
  } else {
      if($redirect === true){
        header("Location: ../login.php");
      } else {
        return false;
      }
  }
}
 ?>
