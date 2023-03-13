<?php
require_once("config/db.php");
require_once("class/loginStatus.inc.php");
require_once("class/get-form.php");
require_once("web-data/web-data-conn.inc.php");
date_default_timezone_set('Asia/Kolkata');
$date=date('Y-m-d H:i:s');
$user_data = login_status($conn,true);
if ((isset($_GET['id']))&&(isset($_GET['web']))) {
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $web = mysqli_real_escape_string($conn, $_GET['web']);
} else {
  $id = mysqli_real_escape_string($conn, "0");
  $web = mysqli_real_escape_string($conn, "false");
}

$sql = "SELECT * FROM `forms` WHERE `id` = '$id'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  while($row = $result->fetch_assoc()) {
    $user_client_name = $row['name'];
    $user_client_status = $row['status'];
    $track_status_client = $row['track_status'];
    $track_stage_id = $row['track_stage_id'];
    $user_number = $row['number'];
    $user_email = $row['email'];
    $form_id = $row['form_id'];
    $other_web_table_name = $row['type'];
    $payment_id = $row['payment_id'];
    $order_id = $row['order_id'];
    $payment_status_check = $row['payment_status_check'];
    $product_price = $row['price'];
    $merchent_name = $row['merchent_name'];
    $track_details = $row['tracking_details'];
    $remarks_details = $row['remarks'];
    $assign_processor_id = $row['processor_id'];
    $assign_sales_id = $row['sales_id'];


    $sql_filter = "SELECT * FROM `track_stages` where id = $track_stage_id";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows == 1) {
      while($row_filter = $result_filter->fetch_assoc()) {
        $client_stage = $row_filter['stage'];
      }
    }

  }
} else {
  include("views/form-alert.html.php");
}
$editabe_user_full_link_result = $conn->query("SELECT `full_link` FROM `editable_link` WHERE `pannel_form_id` = '".$id."'");
if ($editabe_user_full_link_result->num_rows == 1) {
  while($editabe_user_full_link_row = $editabe_user_full_link_result->fetch_assoc()) {
      $editabe_user_full_link_form = $editabe_user_full_link_row['full_link'];
  }
}else{
    $editabe_user_full_link_form = 'None';
}
?>

<!DOCTYPE html>
<html>
<title>CRM</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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


  <div class="w3-container">
       <br>
  <?php

    if ((isset($_POST['stage_name']))&&(isset($_POST['mark_stage']))) {
          require('action/mark-stage-action.php');
        }
    ?>
  <div class="" style="justify-content: flex-start;align-items: center;display: flex;">
      <form action="" method="post" style="justify-content: flex-start;align-items: center;display: flex;">

    <div class="">
<select name="stage_name" id="stage_name" class="w3-input w3-border search" required="">
     <?php
    $sql_filter = "SELECT * FROM `track_stages`";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows > 0) {
      while($row_filter = $result_filter->fetch_assoc()) {
        echo '<option value="'.$row_filter['id'].'">'.$row_filter['stage'].'</option>';
      }
    } else {
      echo '<option value="1"></option>';
    }
    ?>

      </select>
</div>


<input type="hidden" name="mark_stage" value="mark_stage" >
  <div>
    <button class="w3-button w3-teal" type="submit">Stage</button>
  </div>
  </form>
  </div>
  <div class="w3-panel">
    <div class="" style="margin:0 -16px">
        <div class="w3-container w3-teal">
    <h5 style="float: left;">User Info (Sale: <?php echo UserAssignForm($assign_sales_id,$conn);?>, Process: <?php echo UserAssignForm($assign_processor_id,$conn);?>)</h5>
    <h6 style="float: right;"><?php echo $user_client_name."/".$user_client_status."/".$track_status_client."/".$client_stage; ?></h6>
    </div>
        <table class="w3-table-all w3-bordered">
          <?php
          $other_conn = other_web_conn($web_data[$web]['hostname'], $web_data[$web]['username'], $web_data[$web]['password'], $web_data[$web]['database']);
          $sql = "SHOW COLUMNS FROM `".$web_data[$web]['table'][$other_web_table_name]."`";
          $result = $other_conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $one_form = $other_conn->query("SELECT * FROM `".$web_data[$web]['table'][$other_web_table_name]."` WHERE  `id` = $form_id");if ($one_form->num_rows == 1) {$one_form_row = $one_form->fetch_assoc();
            echo"<tr>
                  <th>".$row['Field'].": </th>
                  <td>".$one_form_row[$row['Field']]."</td>
                </tr>";
            } }
          } else {
            echo"<tr>
                  <th>0 Result</th>
                  <td>0 Result</td>
                </tr>";
          }
          ?>
        </table>
    </div>
  </div>
</div>
<div class="w3-container">
    <div class="w3-panel w3-bule w3-border" style="padding-bottom: 0px;background: #009688;">
      <table class="w3-table-all">
<tr>
  <th>Payment Info Problem:</th>
  <th><?php echo $payment_status_check; ?></th>
</tr>
<tr>
  <th>Order Id:</th>
  <th><?php echo $order_id; ?></th>
</tr>
<tr>
  <th>Payment Id:</th>
  <th><?php echo $payment_id; ?></th>
</tr>
<tr>
  <th>Amount:</th>
  <th><?php echo $product_price; ?></th>
</tr>
<tr>
  <th>Merchent:</th>
  <th><?php echo $merchent_name; ?></th>
</tr>
</table>
</div>
</div>
<div class="w3-container">
    <?php if($editabe_user_full_link_form != 'None'){ ?>
    <button id="form_link_btn" onclick='window.prompt("Copy to clipboard: Ctrl+C, Enter", "<?php echo $editabe_user_full_link_form ?>");' class="w3-button w3-teal">User Form Link</button>
    <?php } ?>
  <button id="otp_btn" onclick="sent_otp();document.getElementById('id01').style.display='block'" class="w3-button w3-teal">OTP</button>
  <button id="otp_sms_btn" onclick="sent_sms_otp();document.getElementById('id01').style.display='block'" class="w3-button w3-teal">SMS OTP</button>
  <button id="pay_btn" onclick="send_pay_link();" class="w3-button w3-teal">Paymant Link </button>
  <div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      <p id="opt">Please Wait...</p>
    </div>
  </div>
</div>
<a href="/action/user-from-process.php?id=<?php echo $id ?>"><button  class="w3-button w3-teal">Process </button></a>
<a href="/action/user-from-done.php?id=<?php echo $id ?>"><button  class="w3-button w3-teal">Done </button></a>
<a href="/action/user-from-drop.php?id=<?php echo $id ?>"><button  class="w3-button w3-teal">Drop </button></a>
<a href="/action/user-from-refund.php?id=<?php echo $id ?>"><button  class="w3-button w3-teal">Refund </button></a>
</div>
  <hr>
  <div class="w3-container">
    <div class="w3-container w3-teal">
    <h2>Mail</h2>
    </div>
    <?php
    if ((isset($_POST['mail_to']))&&(isset($_POST['mail_from']))&&(isset($_POST['mail_sbj']))&&(isset($_POST['mail_msg']))) {
      require('action/mail-send-to-client.php');
    }
    ?>
    <form method="post" action="" class="w3-container w3-white w3-border" enctype='multipart/form-data'>
    <br>
    <p>
    <label class="w3-text-grey">Type</label>
    <select name="mail_type" id="mail_type" class="w3-input w3-border" required="">
      <?php
      $sql = "SELECT `id`,`mail_dropdown_type` FROM `all_mail` WHERE `web` = '$web'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<option value="'.$row['id'].'">'.$row['mail_dropdown_type'].'</option>';
        }
      } else {
        echo '<option value="">0 Result</option>';
      }
      ?>
    </select>
    </p>
    <p>
    <label class="w3-text-grey">Email</label>
    <input name="mail_from" class="w3-input w3-border" id="mail_from" type="text" value="" required="">
    </p>
    <p>
    <label class="w3-text-grey">To</label>
    <input name="mail_to" class="w3-input w3-border" id="mail_to" type="text" value="<?php echo $user_email; ?>" required="">
    </p>
    <p>
    <label class="w3-text-grey">Subject</label>
    <textarea name="mail_sbj" class="w3-input w3-border" id="mail_sbj" style="resize:none"></textarea>
    </p>
    <p>
    <label class="w3-text-grey">Message</label>
    <textarea name="mail_msg" class="w3-input w3-border" id="mail_msg" rows="12"></textarea>
    </p>
    <br>
    <input type="file" class="w3-button w3-teal" name="mail_file[]"/>
    <br>
    <p><button type="submit" class="w3-btn w3-padding w3-teal" style="width:120px">Send &nbsp; ❯</button></p>
  </form>
  </div>
  <div class="w3-container">
    <div class="w3-panel w3-pale-teal w3-white w3-topbar w3-bottombar w3-border-teal">
  <h3>Payment History</h3>
  <p>
            <?php

  $sql_pay_history = "SELECT * FROM `payment_list` WHERE `email` = '".$user_email."' OR `number` = '".$user_number."'";
$result_pay_history = $conn->query($sql_pay_history);
if ($result_pay_history->num_rows > 0) {
    while($row_pay_history = $result_pay_history->fetch_assoc()) {
    ?>
          <table class="w3-table">
<tr>
  <th>Payment Id:</th>
  <th><?php echo $row_pay_history['payment_id']; ?></th>
</tr>
<tr>
  <th>Amount:</th>
  <th><?php echo $row_pay_history['price']; ?></th>
</tr>
<tr>
  <th>Merchent:</th>
  <th><?php echo $row_pay_history['merchent_id']; ?></th>
</tr>
</table>
<?php }} ?>


  </p>
</div>
<div class="">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="w3-white w3-border">
            <div class="w3-container w3-teal">
    <h2>Chat</h2>
    </div>
         <div class="w3-container w3-white">
         <?php
        if ((isset($_POST['complaint_details_submit']))&&(isset($_POST['Complaint']))) {
          require('action/complaint-order-action.php');
        }
        $sql = "SELECT * FROM `message` WHERE mobile = '".$user_number."' AND `type` = 'complaint';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0 ) {
            while($row = $result->fetch_assoc()){
                ?>
                <div class="d-flex" style=" display:flex; margin:2px 0px; <?php if($row['route'] == 0){ ?> flex-direction: row-reverse; <?php }  ?> "> <div class="w3-panel w3-teal"><?php echo $row['message']; ?></div> </div>
                <?php
            }
        }
        ?>
        <p><label class="w3-text-grey">Message</label>
        <input name="complaint_msg" class="w3-input w3-border" id="complaint_msg" type="text" required=""></p>
        <input name="complaint_details_submit" value="complaint_details_submit" type="hidden" required="">
        <p><input type="submit" class="w3-button w3-teal" name="Complaint" value="Complaint Send"></p>
         </div>
        </div>
    </form>
    </div>


<?php

if ((isset($_POST['track_details_submit']))&&(isset($_POST['track_details_submit']))) {
      require('action/track-order-action.php');
    }
    if ((isset($_POST['remarks_details_submit']))&&(isset($_POST['remarks_details_submit']))) {
      require('action/remarks-add.php');
    }
?>
<br>
<div style="display:flex;">
<div class="" style="flex:6;">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="w3-white w3-border">
            <div class="w3-container w3-teal">
    <h2>Track</h2>
    </div>
    <div class="w3-container w3-white">
      <p><label for="Track Details" class="w3-text-grey"><div>Details</div></label>
      <input name="track_details" class="w3-input w3-border" id="track_details" value="<?php echo $track_details; ?>" type="text" required=""></p>
      <p><input name="track_details_submit" value="track_details_submit" type="hidden" required="">
      <input type="submit" class="w3-button w3-teal" name="Submit Track Details" value="Submit Track Details"></p>
         </div>
        </div>
    </form>
    </div>

<br>
<div class="" style="flex:6;">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="w3-white w3-border">
            <div class="w3-container w3-teal">
    <h2>Remarks</h2>
    </div>
    <div class="w3-container w3-white">
      <p><label for="Remarks Details" class="w3-text-grey"><div>Remarks</div></label>
      <input name="remarks_details" class="w3-input w3-border" id="remarks_details" value="<?php echo $remarks_details; ?>" type="text" required=""></p>
      <p><input name="remarks_details_submit" value="remarks_details_submit" type="hidden" required="">
      <input type="submit" class="w3-button w3-teal" name="Submit Remarks Details" value="Submit Remarks Details"></p>
    </div>
  </form>
           </div>
        </div>
    </form>
    </div>

    </div>




</div>
  <!-- Footer -->
  <?php include(''); ?>

  <!-- End page content -->
</div>

<script>
 CKEDITOR.replace( 'mail_msg' );
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

function default_msg(){
  var mail_type_id = $("#mail_type").children("option:selected").val();
  $.get("/action/mail-to-client.php?web=<?php echo $web; ?>&id="+mail_type_id, function(data, status){
    var obj = JSON.parse(data);
    $("#mail_from").val(obj.mail_from);
    $("#mail_sbj").text(obj.mail_sbj);
  });
    $.get("/action/mail-to-client-get-msg.php?web=<?php echo $web; ?>&id="+mail_type_id, function(data, status){
         CKEDITOR.instances.mail_msg.setData(data);
          });
}


$(document).ready(function(){
    $("#mail_type").change(function(){
        var mail_type_id = $(this).children("option:selected").val();
        $.get("/action/mail-to-client.php?web=<?php echo $web; ?>&id="+mail_type_id, function(data, status){
          var obj = JSON.parse(data);
          $("#mail_from").val(obj.mail_from);
          $("#mail_sbj").text(obj.mail_sbj);
        });
        $.get("/action/mail-to-client-get-msg.php?web=<?php echo $web; ?>&id="+mail_type_id, function(data, status){
          CKEDITOR.instances.mail_msg.setData(data);
          });
    });
  default_msg();
});
function fetch_sync_otp(otp_id){
  var activeRequest = false;
  setInterval(function(){
    if (!activeRequest) {
    $.get("/action/user_dl_fetch_otp.php?id="+otp_id, function(data, status){
      if (status == "success") {
        activeRequest = false;
        $("#opt").html(data);
      }
    });
  }
  activeRequest = true;
  }, 500);
}
function sent_otp(){
  $("#otp_btn").text("Sending..");
  $.get("/action/send-mail-fetch_otp.php?id=<?php echo $id ?>", function(data, status){
    if (status == "success") {
      if(data == "true"){$("#otp_btn").val("Sended");fetch_sync_otp(<?php echo $id ?>);}else{$("#otp_btn").text("Failed");}
    } else {
      $("#otp_btn").text("Failed");
    }

  });
}

function sent_sms_otp(){
  $("#otp_sms_btn").text("Sending..");
  $.get("/action/send-sms-fetch_otp.php?id=<?php echo $id ?>", function(data, status){
    if (status == "success") {
      if(data == "true"){$("#otp_sms_btn").val("Sended");fetch_sync_otp(<?php echo $id ?>);}else{$("#otp_sms_btn").text("Failed");}
    } else {
      $("#otp_sms_btn").text("Failed");
    }

  });
}
function send_pay_link(event){
  $("#pay_btn").text("Sending..");
  $.get("/action/send-mail-pay.php?id=<?php echo $id ?>", function(data, status){
    if (status == "success") {
      if(data == "true"){$("#pay_btn").text("Sended");}else{$("#pay_btn").text("Failed");}
    } else {
      $("#pay_btn").text("Failed");
    }

});
}
</script>
<script>
    // text editor



</script>
</body>
</html>
