<?php
require_once("config/db.php");
require_once("class/loginStatus.inc.php");
require_once("class/get-form.php");
$user_data = login_status($conn,true);
?>

<!DOCTYPE html>
<html>
<title>CRM</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<?php include("views/top-bar.php"); ?>

<!-- Sidebar/menu -->
<?php require('views/side-bar.php'); ?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
test
  <?php include("views/status-header.php"); ?>
  <?php include("views/form-table.php"); ?>
  <hr>
  <div class="w3-container">
  <a href="" class="w3-btn w3-teal previous">&laquo; Previous</a>
  <a href="dashboard.php?status=<?php echo $_GET['status'] ;?>&from_limit=<?php echo $to_limit ;?>&to_limit=<?php echo 30 + (int)$to_limit ;?>" class="w3-btn next  w3-teal">Next &raquo;</a>
 </div>
  <!-- Footer -->
  <?php include('views/footer.php'); ?>

  <!-- End page content -->
</div>

<script>
var mySidebar = document.getElementById("mySidebar");
var overlayBg = document.getElementById("myOverlay");
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
