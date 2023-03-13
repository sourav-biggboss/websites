<?php
require("./config.php");

if (isset($_POST['complaint_id']) && ($_POST['complaint_id'] != '')) {
    $sql_update_complaint = 'UPDATE complaint_forms SET status = "true" WHERE complaint_id = "'.$_POST['complaint_id'].'"';
    $result_update_complaint = $conn->query($sql_update_complaint);

    if ($result_update_complaint) {
        echo 'Form updated';
    }
}

?>