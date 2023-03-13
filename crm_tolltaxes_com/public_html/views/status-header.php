<link rel="stylesheet" href="/assets/css/main.css">
<div class="w3-row-padding" style="display: flex;" id="track_status">
  <?php if($_COOKIE['roll_type'] == 'ADMIN') { ?>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'total') {echo 'card-active-status';} ?>  "><a href="dashboard.php?status=total" style="text-decoration: none;">
    <div class="w3-container w3-red w3-padding-16">
      <div class="w3-left"><i class="fa fa-globe w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","ALL","ALL",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Total</h4>
    </div>
  </div></a>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'paid') {echo 'card-active-status';} ?>   "><a href="dashboard.php?status=paid" style="text-decoration: none;">
    <div class="w3-container w3-blue w3-padding-16">
      <div class="w3-left"><i class="fa fa-product-hunt w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","Paid","ALL",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Paid</h4>
    </div>
  </div></a>
    <?php } ?>
    <?php if((($_COOKIE['roll_type'] == 'SALE') || ($_COOKIE['roll_type'] == 'PROCESSER') ) || ($_COOKIE['roll_type'] == 'ADMIN')) { ?>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'unpaid') {echo 'card-active-status';} ?> "><a href="dashboard.php?status=unpaid" style="text-decoration: none;">
    <div class="w3-container w3-teal w3-padding-16">
      <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","Unpaid","ALL",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Unpaid</h4>
    </div>
  </div></a>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'process') {echo 'card-active-status';} ?> "><a href="dashboard.php?status=process" style="text-decoration: none;">
    <div class="w3-container w3-green w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","ALL","Process",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Process</h4>
    </div>
  </div></a>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'done') {echo 'card-active-status';} ?> "><a href="dashboard.php?status=done" style="text-decoration: none;">
    <div class="w3-container w3-orange w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","ALL","Done",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Done</h4>
    </div>
  </div></a>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'drop') {echo 'card-active-status';} ?> "><a href="dashboard.php?status=drop" style="text-decoration: none;">
    <div class="w3-container w3-red w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","ALL","Drop",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Drop</h4>
    </div>
  </div></a>
  <div class="w3-quarter status <?php if( (isset($_GET['status'])) && $_GET['status'] == 'refund') {echo 'card-active-status';} ?> "><a href="dashboard.php?status=refund" style="text-decoration: none;">
    <div class="w3-container w3-yellow w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo get_form_num("ALL","ALL","Refund",$conn); ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Refund</h4>
    </div>
  </div></a>
<?php } ?>
</div>
<br>
<style>
    .search{
    background: #fff!important;
    display: block!important;
    padding: 8px!important;
    margin: 0px!important;
}
#filterFormTglModel{
    display:none;
}
.mystyle {
        display: block!important;
    width: 100%;
    padding: 16px 0px;
    background-color: #Fff;
    color: white;
    /* font-size: 25px; */
    box-sizing: border-box;
    margin-top: 20px;
}
}
</style>
</style>

<div class="w3-row-padding" style="padding: 0px 16px;">
    <div style="justify-content: flex-start;align-items: center;display: flex;">
  <div class="" style="justify-content: flex-start;align-items: center;display: flex;">
      <form action="/dashboard.php?status=total" method="get" style="justify-content: flex-start;align-items: center;display: flex;">

    <div class="">
<input class="w3-input w3-border search" type="text" name="q" placeholder="Search.. Number / Mobile / Order Id">
</div>
<div class="">
    <button class="w3-button w3-teal" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>
  </form>
  </div>
  <div>


      <button class="w3-button w3-teal" onclick="filterFormTglBtn()" style="margin-left: 15px;"><i class="fa fa-filter" aria-hidden="true"></i></button>
  </div>
</div>

<div id="filterFormTglModel" class=" w3-text-teal">
    <form action="/dashboard.php?status=filter" method="get">
<div class="w3-row-padding">
  <div class="w3-third"><p>Choose Wesite</p>
     <select class="w3-select w3-border" name="fiter_web">
    <option value="" disabled>Choose Wesite</option>
    <option value="ALL" selected>ALL</option>
    <?php
    $sql_filter = "SELECT web FROM forms GROUP BY web";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows > 0) {
      while($row_filter = $result_filter->fetch_assoc()) {
        echo '<option value="'.$row_filter['web'].'">'.$row_filter['web'].'</option>';
      }
    } else {
      echo '<option value="1"></option>';
    }
    ?>
  </select>
  </div>
  <div class="w3-third"><p>Choose Status</p>
     <select class="w3-select w3-border" name="fiter_status">
    <option value="" disabled>Choose Status</option>
    <option value="ALL" selected>ALL</option>
    <?php
    $sql_filter = "SELECT track_status FROM forms GROUP BY track_status";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows > 0) {
      while($row_filter = $result_filter->fetch_assoc()) {
        echo '<option value="'.$row_filter['track_status'].'">'.$row_filter['track_status'].'</option>';
      }
    } else {
      echo '<option value="1"></option>';
    }
    ?>
  </select>
  </div>
  <div class="w3-third"><p>Choose Stage</p>
    <select class="w3-select w3-border" name="fiter_stage">
    <option value="" disabled>Choose Stage</option>
    <option value="ALL" selected>ALL</option>
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
  <div class="w3-third"><p>Choose Price</p>
    <select class="w3-select w3-border" name="fiter_price">
    <option value=""  disabled>Choose Price</option>
    <option value="ALL" selected>ALL</option>
     <?php
    $sql_filter = "SELECT price FROM `forms` GROUP BY price";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows > 0) {
      while($row_filter = $result_filter->fetch_assoc()) {
        echo '<option value="'.$row_filter['price'].'">'.$row_filter['price'].'</option>';
      }
    } else {
      echo '<option value="1"></option>';
    }
    ?>
  </select>
  </div>
  <div class="w3-third"><p>Order By</p>
    <select class="w3-select w3-border" name="fiter_orderby">
    <option value=""  disabled>Choose Order BY</option>
     <option value="ASC">ASC</option>
     <option value="DESC" selected>DESC</option>
  </select>
  </div>
  <div class="w3-third"><p>Limit</p>
    <select class="w3-select w3-border" name="fiter_limit">
    <option value="" disabled>Choose Limit</option>
    <option value="30" selected>30 Default</option>
    <option value="40" >40</option>
    <option value="100" >100</option>
    <option value="300" >300</option>
     <option value="500">500</option>
     <option value="ALL">ALL</option>
  </select>
  </div>
  <div class="w3-third"><p>Choose Assign</p>
    <select class="w3-select w3-border" name="fiter_assign">
    <option value="" disabled>Choose Assign</option>
    <option value="ALL" selected>ALL</option>
    <?php
    $sql_filter = "SELECT * FROM `users`";
    $result_filter = $conn->query($sql_filter);
    if ($result_filter->num_rows > 0) {
      while($row_filter = $result_filter->fetch_assoc()) {
        echo '<option value="'.$row_filter['id'].'">'.$row_filter['name'].'</option>';
      }
    } else {
      echo '<option value="1"></option>';
    }
    ?>
  </select>
  </div>
  <div class="w3-third"><p>Choose From Date</p>
    <input class="w3-input w3-border" name="fiter_fromdate" type="date" value="ALL" placeholder="Choose From Date">
  </div>
  <div class="w3-third"><p>Choose To  Date</p>
   <input class="w3-input w3-border" name="fiter_todate" type="date" value="ALL" placeholder="Choose To  Date">
  </div>
  <input type="hidden" name="status" value="filter">
  <div class="w3-third">
      <br>
    <input class="w3-button w3-teal" name="filter" value="submit" type="submit" >
  </div>
</div>
</div>
</form>
</div>
<script type="text/javascript" src="/assets/js/track-status-active.js"></script>
<script>
function filterFormTglBtn() {
   var element = document.getElementById("filterFormTglModel");
   element.classList.toggle("mystyle");
}
</script>
