<?php
require_once("../config/db.php");
require_once("../class/logout.inc.php");
logout_user($conn, true);
?>
