<?php
require_once("../config/db.php");

$result= $conn->query("UPDATE `campain_log` SET `status`= 0 WHERE id ='".$_GET['id']."'");
if($result){
    echo "<script>alert('Pause Campin');window.history.back();</script>";
} else {
     echo "<script>alert('Error ! Pause Campin');window.history.back();</script>";
}
?>