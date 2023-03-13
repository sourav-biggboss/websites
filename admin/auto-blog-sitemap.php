<?php
$web = "TOLLTAXES.COM";
require("crm_db_conn.php");
// to crm db
$connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

$sql = "SELECT `page_url`,`w3c_sitemap_timestamp` FROM `insert_blog` WHERE `website_name` = '$web'";
$result = $connect->query($sql);
if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
   echo " <url>
    <loc>".$row['page_url']."</loc>
    <lastmod>".$row['w3c_sitemap_timestamp']."</lastmod>
    <priority>0.80</priority>
  </url>";
  }
}
?>