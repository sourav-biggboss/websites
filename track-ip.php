<?php
        if (isset($_GET['user_id']) && $_GET['user_id'] != '') {
        $ch = curl_init('https://crm2.techlounge.co.in/api/track-ip.php?ip='.$_GET["ip"].'&url='.$_GET["url"].'&user_id='.$_GET["user_id"].'&status='.$_GET["status"].'');
    } else {
        $ch = curl_init('https://crm2.techlounge.co.in/api/track-ip.php?ip='.$_GET["ip"].'&url='.$_GET["url"].'&status='.$_GET["status"].'');
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

?>