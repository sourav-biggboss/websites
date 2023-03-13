<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/assets/img/<?php echo $user_data["user_img"]; ?>" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong> <?php echo $user_data["name"]; ?></strong></span><br>
      <!--<a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>-->
      <!--<a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>-->
      <!--<a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>-->
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block" id="nav-menu-links">

    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
      <?php if((($_COOKIE['roll_type'] == 'SALE') || ($_COOKIE['roll_type'] == 'PROCESSER') ) || ($_COOKIE['roll_type'] == 'ADMIN')) { ?><a href="dashboard.php" class="w3-bar-item w3-button w3-padding" id="dashboard"><i class="fa fa-users fa-fw"></i>Overview</a> <?php } ?>
      <?php if(($_COOKIE['roll_type'] == 'SALE' || ($_COOKIE['roll_type'] == 'PROCESSER')) || ($_COOKIE['roll_type'] == 'ADMIN')) { ?><a href="/complaint.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>Complaint</a><?php } ?>
      <?php if(($_COOKIE['roll_type'] == 'DM') || ($_COOKIE['roll_type'] == 'ADMIN')) { ?><a href="blog.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>Blog</a><?php } ?>
        <?php if($_COOKIE['roll_type'] == 'ADMIN') { ?>
        <a href="add-issue-mail.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>Add mail</a>
        <a href="/campain.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>Campaign</a>
      <?php } ?>
  </div>
</nav>

<script>
$(document).ready(function(){
    //sid bar active
     var path = window.location.href;
     $('#nav-menu-links a').each(function() {
      if (this.href === path) {
       $(this).addClass('w3-blue');
      }
     });

});
</script>
