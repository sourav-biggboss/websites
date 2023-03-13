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
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
label{
    color:#757575!important;
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
  <!--import-->
  <br>
  <div class="w3-container">
  <form method="post" action="" enctype="multipart/form-data" class="w3-border">
      <div class="w3-container w3-teal">
    <h2>Import Data</h2>
    </div>
    <div class="container">
      <?php
        if (isset($_POST["import"])) {
        $fileName = $_FILES["csv"]["tmp_name"];
        if ($_FILES["csv"]["size"] > 0) {
            $file = fopen($fileName, "r");
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $type_web = $_POST['import_type'];
                $name = "";
                if (isset($column[0])) {
                    $name = mysqli_real_escape_string($conn, $column[0]);
                }
                $number = "";
                if (isset($column[1])) {
                    $number = mysqli_real_escape_string($conn, $column[1]);
                }
                $email = "";
                if (isset($column[2])) {
                    $email = mysqli_real_escape_string($conn, $column[2]);
                }
                $sqlInsert = "INSERT into campain_data (type,name,number,email)
                       values ('$type_web','$name','$number','$email')";
                $insertId = $conn->query($sqlInsert);
                if ($insertId === TRUE) {
                    $type = "success";
                   include("views/blog-success.php");
                } else {
                    $type = "error";

                }
            }
                                include("views/blog-alert.php");
        }
        }
      ?>
      <label for="Type">Type</label>
      <select id="type" name="import_type" required>
        <?php
      foreach ($web_data  as $webname => $stucture) {
        echo "<option value='".strtoupper($web_data[$webname]['type'])."'>".$web_data[$webname]['type']."</option>" ;
        }
        ?>
      </select>
      <br>
      <label for="Csv">Csv<p>name,number,email</p></label>
      <input name="csv" class="w3-input" id="csv" type="file" required></textarea>
      <br>
      <input type="submit" class="w3-button w3-teal" name="import" value="import">
    </div>
  </form>
  </div>
  <br>
  
  
  <!--delete-->
  
  
  
    <div class="w3-container">
  <form method="post" action="" enctype="multipart/form-data" class="w3-border">
      <div class="w3-container w3-teal">
    <h2>Delete Data</h2>
    </div>
    <div class="container">
      <?php
        if (isset($_POST["delete"])) {
               $sqlInsert = "DELETE FROM `campain_data` WHERE type ='".$_POST['delete_type']."'";
                $insertId = $conn->query($sqlInsert);
                if ($insertId === TRUE) {
                    $type = "success";
                   include("views/blog-success.php");
                } else {
                    $type = "error";
                    include("views/blog-alert.php");
                }
        }
      ?>
      <label for="Type">Type</label>
      <select id="type" name="delete_type" required>
        <?php
      foreach ($web_data  as $webname => $stucture) {
        echo "<option value='".strtoupper($web_data[$webname]['type'])."'>".$web_data[$webname]['type']."</option>" ;
        }
        ?>
      </select>
      <input type="submit" class="w3-button w3-teal" name="delete" value="delete"
    </div>
  </form>
  </div>
  <br>
  
  
  
  
  
  
  
  
  
  
  
  
  
  <!--start campin-->
   <div class="">
   <form method="post" action="" class="w3-border">
       <div class="w3-container w3-teal">
    <h2>Start Campain</h2>
    </div>
    <div class="container">
      <?php
        if (isset($_POST["start_campain"])) {
            $web = $_POST["website_name"];
              $sqlInsert = "INSERT into campain_log (web,type,campain_type,sbj,status)
                       values ('".$web."','".$web_data[$web]['type']."','".$_POST["type"]."','".mysqli_real_escape_string($conn,$_POST['subject'])."','1')";
                $insertId = $conn->query($sqlInsert);
                if ($insertId === TRUE) {
                    $type = "success";
                    sleep(3);
                    $ch = curl_init('http://crm.tolltaxes.com/action/campain_action.php');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                   include("views/blog-success.php");
                } else {
                    $type = "error";
                    include("views/blog-alert.php");
                }
        }
      ?>

      <label for="Website Name">Website Name</label>
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

      <label for="Type">Type Method</label>
      <select id="Type" name="type" required>
        <option value="MAIL" selected>Mail</option>
    </select>

      <label for="Subject">Subject (max word:100)</label>
      <input type="text" placeholder="Subject" name="subject" id="subject" required>
      <input type="hidden" name="start_campain" name="start_campain" >
      <input type="submit" class="w3-button w3-teal" name="Sart Campain" value="Sart Campain">
      <a href="/action/campain-flush.php" class="w3-button w3-teal">Debug</a>
    </div>
  </form>
  </div>
  <br>
<!--LOg-->
  <div class="w3-border">
      <div class="w3-row-padding" style="background:#fff;">
        <?php
        $sql_data = 'SELECT SUM(`send`) as client_recive , COUNT(`id`) as total_client_data FROM `campain_data`';
         $result_data = $conn->query($sql_data);
         if ($result_data->num_rows > 0) {
           while($row_data = $result_data->fetch_assoc()) {
               $total_sended= $row_data['client_recive'];
               $total_client_data = $row_data['total_client_data'];
           }
         }
         $sql = 'SELECT * FROM `campain_log`';
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
               $web = $row['web'];
               if($row['status']){$status = "Running";} else {$status = "Pause";}
               $campain_type = $row['campain_type'];
               $sbj = $row['sbj'];
               $total_sended = $row['total_sended'];
               $dnf = (int)$total_sended - (int)$total_sended;
               $date = $row['date'];
               $id = $row['id'];
            ?>
                  <div class="w3-third">
        <h3>Log <?php echo strtolower($web); ?></h3>
        <?php include('log/campain-log.html'); ?>
      </div>
              <div class="w3-twothird">
        <h3>Feeds <?php echo strtolower($web); ?></h3>
        <table class="w3-table w3-striped w3-white">
          <tbody>
              <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Website.</td>
            <td><i><?php echo strtolower($web); ?></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Status.</td>
            <td><i><?php echo $status; ?></i> <i><a href="/action/campain-resume.php?id=<?php echo $id; ?>" class="w3-button w3-teal">Resume</a></i><i><a href="/action/campain-pause.php?id=<?php echo $id; ?>" class="w3-button w3-teal">pause</a></i><a href="/action/campain-delete.php?id=<?php echo $id; ?>" class="w3-button w3-teal">Remove</a></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Type.</td>
            <td><i><?php echo $campain_type; ?></i></td>
          </tr>
              <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td>Sended</td>
            <td><i><?php echo $total_sended; ?></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Dnf.</td>
            <td><i><?php echo $dnf; ?></i></td>
          </tr>
          
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>Total Data</td>
            <td><i><?php echo $total_client_data; ?></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>Remaining Data</td>
            <td><i><?php echo (int)$total_client_data - (int)$total_sended; ?></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Date</td>
            <td><i><?php echo $date; ?></i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Subject</td>
            <td><i><?php echo $sbj; ?></i></td>
          </tr>
        </tbody></table>
              </div>
        <?php
           }
         } else {
           echo "<div class='w3-container'>
        <h5>Feeds</h5><table><tdody><tr>
            <td></td>
            <td>0</td>
            <td><i>No Campain</i></td>
          </tr>
        </tbody></table>      </div>";
         }
        ?>

</div>
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
