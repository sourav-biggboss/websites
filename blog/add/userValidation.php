<?php
$pass_saved="freeDom@199#";
if ((isset($_POST['pin'])) && ($_POST['pin'] != '') && ($_POST['pin'] == $pass_saved)  && ($_POST['login'] == 'login')) {
    // setting user cookies
    setcookie("userAuth", $pass_saved, time() + (86400 * 30), "/");
} else {
    // destory user cookies
    setcookie("userAuth", "", time() + (5), "/");
}
   header('Location: ./');
?>
