<?php
if(isset($_GET['id'])){
    $web = "TOLLTAXES.COM";
    require("crm_db_conn.php");
    // to crm db
    $connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
    if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
    }

    $sql = "UPDATE `insert_faqs` SET `views` = `views` + 1 WHERE `id` = '".$_GET['id']."' AND `website_name` = '$web'";
    if ($connect->query($sql) === TRUE) {
    echo true;
    } else {
    echo false;
    }
}
?>
