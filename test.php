<?php $allow = array("157.42.28.144","157.35.231.208"); //allowed IPs

    header("Location: index.php"); //redirect

if(!in_array($_SERVER['REMOTE_ADDR'], $allow) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $allow)) {

    header("Location: 404.php"); //redirect

    exit();

}
 ?>