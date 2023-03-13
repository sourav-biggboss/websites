<?php
require_once("../config/db.php");
$seconds = 100;
$conn->query("UPDATE `campain_log` SET `status`= 0 ,total_sended = 0 ");
$conn->query("UPDATE `campain_data` SET `send`= 0 ");
sleep($seconds);
$conn->query("UPDATE `campain_log` SET `status`= 1");
?>
<script>alert('Rested Campin');window.history.back();</script>