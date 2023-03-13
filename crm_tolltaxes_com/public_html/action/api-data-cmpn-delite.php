<?php

require_once("/home/u351579040/domains/tolltaxes.com/public_html/crm_tolltaxes_com/public_html/config/db.php");
if(mysqli_query($conn,"DELETE FROM `campain_data` ")){
    echo 'flushed';
}
mysqli_query($conn,"UPDATE `campain_log` SET total_sended = 0 WHERE type = '".$bussness."'");
?>