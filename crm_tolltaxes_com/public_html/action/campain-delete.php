<?php
require_once("../config/db.php");

$result= $conn->query("DELETE FROM `campain_log` WHERE id ='".$_GET['id']."'");
if($result){
    echo "<script>alert('Delete Campin');window.history.back();</script>";
} else {
     echo "<script>alert('Error ! Delete Campin');window.history.back();</script>";
}
?>