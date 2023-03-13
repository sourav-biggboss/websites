<?php
require_once("config/db.php");
require_once("class/loginStatus.inc.php");
require_once("class/get-form.php");
require_once("web-data/web-data.json.inc.php");
$user_data = login_status($conn,true);
date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html>
<title>CRM</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/login.css">
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
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

  <?php include("views/status-header.php"); ?>
  <br>
  <div class="w3-container">
  <form method="post" action="" class="w3-border">
      <div class="w3-container w3-teal">
    <h2>Add Mail</h2>
    </div>
    <div class="container">
      <?php
      if ((isset($_POST["website_name"]))&&(isset($_POST["form_mail"]))&&(isset($_POST["issue_type"]))&&(isset($_POST["subject"]))&&(isset($_POST["message"]))) {
        $sql = "INSERT INTO `all_mail` (`web`,`type` ,`mail_dropdown_type`, `mail_from`, `sbj`, `msg`) VALUES ('".$_POST['website_name']."','".mysqli_real_escape_string($conn,$web_data[$_POST["website_name"]]['type'])."','".mysqli_real_escape_string($conn,$_POST['issue_type'])."','".mysqli_real_escape_string($conn,$_POST['form_mail'])."','".mysqli_real_escape_string($conn,$_POST['subject'])."','".mysqli_real_escape_string($conn,preg_replace("/\r|\n/", "",$_POST['message']))."')";
        if ($conn->query($sql) === TRUE) { 
          include("views/blog-success.php");
        } else {
          include("views/blog-alert.php");
        }
        // echo login_user($_POST["email"],$_POST["password"], $conn);
      }
      ?>
      <label for="Website Name"class="w3-text-grey" class="w3-text-grey">Website Name</label>
      <select id="website_name" name="website_name" required>
        <option value="" selected="" disabled="" hidden=""> Select Website </option>
        <?php
         $sql = "SELECT `web` FROM `web-data`";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
             echo "<option value='".strtoupper($row['web'])."'>".strtoupper($row['web'])."</option>";
           }
         } else {
           echo "<option>0 results</option>";
         }
        ?>
      </select>
      <br>
      <label for="Email" class="w3-text-grey">Email</label>
      <select id="form_mail" name="form_mail" required>
        <option value="" selected="" disabled="" hidden=""> Select Email </option>
        <?php
         $sql = "SELECT `mail` FROM `mail_config`";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
             echo "<option value='".$row['mail']."'>".$row['mail']."</option>";
           }
         } else {
           echo "<option>0 results</option>";
         }
        ?>
      </select>
      <br>

      <label for="Type" class="w3-text-grey">Type</label>
      <input type="text" placeholder="Type" name="issue_type" id="issue_type" required>

      <label for="Subject" class="w3-text-grey">Subject (max word:100)</label>
      <input type="text" placeholder="Subject" name="subject" id="subject" required>

      <label for="Message" class="w3-text-grey">Message</label>
      <textarea name="message" class="w3-input" id="message" rows="12" required></textarea>
      <br>
      <button type="submit" class="registerbtn w3-teal">Submit</button>
    </div>
  </form>
</div>
  <hr>
  <!-- Footer -->
  <?php include('views/footer.php'); ?>

  <!-- End page content -->
</div>

<script>
 CKEDITOR.replace( 'message' );
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
