<?php header ("Content-Type:text/xml"); ?>
<?php
if((isset($_GET['website'])) && ($_GET['website'] != '')){
    $web = $_GET['website'];
} else {
    $web = strtoupper($_SERVER['SERVER_NAME']);
}

require_once("../config/db.php");
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