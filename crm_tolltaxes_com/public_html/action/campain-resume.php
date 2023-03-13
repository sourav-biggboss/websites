<?php
require_once("../config/db.php");

$result= $conn->query("UPDATE `campain_log` SET `status`= 1 WHERE id ='".$_GET['id']."'");
if($result){
    echo "<script>alert('started Campin');window.history.back();</script>";
} else {
     echo "<script>alert('Error ! started Campin');window.history.back();</script>";
}
?>