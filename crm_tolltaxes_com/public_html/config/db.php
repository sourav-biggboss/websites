<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define("DB_HOST", "localhost");
    define("DB_NAME", "u129444908_crm");
    define("DB_USER", "root");
    define("DB_PASS", "");
} else {
    define("DB_HOST", "localhost");
    define("DB_NAME", "u129444908_crm");
    define("DB_USER", "u129444908_crm");
    define("DB_PASS", "skill@0Rs");
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
