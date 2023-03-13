<?php
require("./config.php");

if (isset($_POST['meta_id']) && ($_POST['meta_id'] != '')) {
    $sql_insert_timeline =
    "
    INSERT INTO complaint_timeline (
        meta_id,
        meta_name,
        meta_description,
        meta_user,
        form_created_on,
        form_created_time
    )

    VALUES (
        '".$_POST['meta_id']."',
        '".$_POST['meta_name']."',
        '".$_POST["meta_description"]."',
        '".$_POST["meta_user"]."',
        '".$_POST['form_created_on']."',
        '".$_POST['form_created_time']."'
    )
    ";
    $result_insert_timeline = $conn->query($sql_insert_timeline);

    if ($result_insert_timeline) {
        print_r($_POST);
    }
}

?>