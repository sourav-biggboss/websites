<?php
require_once("config/db.php");
require_once("class/loginStatus.inc.php");
require_once("class/get-form.php");
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
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.search{
    background: #fff!important;
    display: block!important;
    padding: 8px!important;
    margin: 0px!important;
}
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
    <h2>Blog Post</h2>
    </div>
    <div class="container">
      <?php
      if ((isset($_POST["website_name"]))&&(isset($_POST["page_url"]))) {
        $objStmpDateTime = new DateTime('NOW');
        $sql = "INSERT INTO `insert_blog` (`website_name`, `author_name`, `page_url`, `image`, `description`, `title`,`w3c_sitemap_timestamp`) VALUES ('".$_POST['website_name']."', '".$_POST['author_name']."','".mysqli_real_escape_string($conn,$_POST['page_url'])."','".mysqli_real_escape_string($conn,$_POST['image'])."','".mysqli_real_escape_string($conn,$_POST['description'])."','".mysqli_real_escape_string($conn,$_POST['title'])."','".$objStmpDateTime->format('c')."')";
        if ($conn->query($sql) === TRUE) {
          include("views/blog-success.php");
        } else {
          include("views/blog-alert.php");
        }
        // echo login_user($_POST["email"],$_POST["password"], $conn);
      }
      ?>
      <label for="Website Name" class="w3-text-grey">Website Name</label>
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
      <label for="Author Name" class="w3-text-grey">Author Name</label>
      <input type="text" placeholder="Author Name" name="author_name" id="author_name" required>

      <label for="Page url" class="w3-text-grey">Page url</label>
      <input type="text" placeholder="Page Url" name="page_url" id="page_url" required>

      <label for="Image" class="w3-text-grey">Image</label>
      <input type="text" placeholder="Image" name="image" id="image" required>

      <label for="Description" class="w3-text-grey">Description</label>
      <input type="text" placeholder="Description" name="description" id="description" required>

      <label for="Title" class="w3-text-grey">Title<</label>
      <input type="text" placeholder="Title" name="title" id="title" required>
      <br>
      <button type="submit" class="registerbtn w3-teal">Submit</button>
    </div>
  </form>
  <br><br>
  <form method="post" action="" class="w3-border">
      <div class="w3-container w3-teal">
    <h2>Faqs Post</h2>
    </div>
    <div class="container">
      <?php
      if ((isset($_POST["website_name"]))&&(isset($_POST["question"]))&&(isset($_POST["answers"]))) {
        $objStmpDateTime = new DateTime('NOW');
        $sql = "INSERT INTO `insert_faqs` (`website_name`, `question`, `answers`,`w3c_sitemap_timestamp`) VALUES ('".$_POST['website_name']."','".mysqli_real_escape_string($conn,$_POST['question'])."','".mysqli_real_escape_string($conn,$_POST['answers'])."','".$objStmpDateTime->format('c')."')";
        if ($conn->query($sql) === TRUE) {
          include("views/blog-success.php");
        } else {
          include("views/blog-alert.php");
        }
      }
      ?>
      <label for="Website Name" class="w3-text-grey">Website Name</label>
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
      <label for="Question" class="w3-text-grey">Question (max word:300)</label>
      <input type="text" placeholder="Question" name="question" id="question" required>

      <label for="Answers" class="w3-text-grey">Answers (max word:800)</label>
      <textarea name="answers" class="w3-input" id="answers" rows="12" required></textarea>
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
