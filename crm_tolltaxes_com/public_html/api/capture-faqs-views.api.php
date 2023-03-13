<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $web = $_GET['website'];
} else {
    $web = strtoupper($_SERVER['SERVER_NAME']);
}

if((isset($_GET['id'])) && ($_GET['id'] != '')){
    $id = $_GET['id'];
} else {
   die();
}
require_once("../config/db.php");
$sql = "UPDATE `insert_faqs` SET `views` = `views` + 1 WHERE `id` = '$id' AND `website_name` = '$web'";

if ($conn->query($sql) === TRUE) {
echo true;
} else {
echo false;
}


?>