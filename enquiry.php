<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Benefits of Fastag | tolltaxes.com</title>
    <meta name="description" content="Check all the uses and benefits of using FASTag. Ease of payment no need to carry cash for the toll transactions saves time.">
<style>
.col-lg-8,.col-lg-4{
      position: relative;
    width: 100%;
    padding-right: 0 !important;
    padding-left: 0 !important;
    }
.fchd {
    background: #343a40 !important;
    color: white;
    font-weight: bold;
    font-size: 14px;
    padding: 10px;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
#enquiryformsub:hover{
  background-color: #FF4500!important;
}
.form-group .form-control {
    border-radius: 0!important;
    border: 0!important;
    border-left: solid 6px #225643!important;
    margin-bottom: 10px;
    background-color: #ddd;
}
</style>
<?php include"header.php";?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
          <div class="title_trnsparant">
            <div class="container p-0 form_en">
            <h5 class="fchd text-center text-white fhdh">QUICK ENQUIRY FORM</h5>
            <form action="submit.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
            <br>
            <div class="form-group col-lg-12 txt  p-2">
            <input type="text" id="fname" name="applicant_name" placeholder="Enter Your Name" class="form-control" required="">
            </div>
            <div class="form-group col-lg-12 txt p-2">
            <input type="tel" id="mobile_number" maxlength="10" minlength="10" class="form-control" placeholder="Enter Your Mobile Number" name="mobile_number" required="">
            </div>
            <div class="form-group col-lg-12 txt p-2">
            <input type="email" id="email_id" name="email_id" placeholder="Please Enter Your Email" class="form-control" required="">
            </div>
            <input type="hidden" name="form_name" value="Fastag Enquiry">
            <br>
            <button type="button" class="btn rounded-0 ml-3 mb-4" id="enquiryformsub" style="background-color:#225643;color:#fff;transition: background-color 0.3s ease-in;"name="submit">ENQUIRE NOW</button>
            </form>
            </div>
          </div>
		      <img src="./assets/img/FasTag_3003.webp" class="d-block w-100 form_en_bk" style=" height: 558px;" alt="...">
		    </div>
		  </div>
		</div>
    <div id="myModal" class="modal" style="display: none;">
      <div class="modal-content" style="width: 700px;">
        <span class="close" style="margin-left: auto;margin-right: 20px;">×</span>
        <p id="enquiryform_popup" ><div style="color:red;"></div></p>
      </div>
    </div>
    <script>
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("enquiryformsub");
  var span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
    $("#fname").val('');
    $("#mobile_number").val('');
    $("#email_id").val('');
  }
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      $("#fname").val('');
      $("#mobile_number").val('');
      $("#email_id").val('');
    }
  }

  $(document).ready(function(){

    $("#enquiryformsub").click(function(){
      $("#enquiryformsub").text('PLEASE WAIT..');
      //console.log("../enquiry.php?applicant_name="+$("#fname").val()+"&mobile_number="+$("#lname").val()+"&email_id="+$("#email_id").val()+"&form_name=Passport Enquiry&form_id=passport_enquiry&sub=''");
     $.get("submit.php?applicant_name="+$("#fname").val()+"&mobile_number="+$("#mobile_number").val()+"&email_id="+$("#email_id").val()+"&form_name=Fastag Enquiry&form_id=fastag_enquiry&sub1=submit",function(data,status){
      $("#enquiryform_popup").html(data);
      modal.style.display = "block";
      $("#enquiryformsub").val('ENQUIRY NOW');
     });
   });

  });
  </script>
  <div class="footer-clean" style="margin-top:0px;">
      <footer>
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-sm-4 col-md-3 item">
                      <h3 style="color:#fff;">Services</h3>
                      <ul>
                          <li><a href="/">Fastag</a></li>
                          <li><a href="./enquiry.php">Enquiry</a></li>
                          <li><a href="./faqs.php">FAQs</a></li>
                          <li><a href="./blog-post/">Blog</a></li>
                      </ul>
                  </div>
                  <div class="col-sm-4 col-md-3 item">
                      <h3 style="color:#fff;">Link</h3>
                      <ul>
                    <li><a href="about-us.php"> About Us </a></li>
                    <li><a href="terms-and-condition.php">Terms &amp; Conditions </a></li>
                    <li><a href="disclaimer.php"> Disclaimer </a></li>
                    <li><a href="privacy-and-policy.php">Privacy &amp; Policies </a></li>
                    <!-- <li><a href="standard-operation-procedure.php">SOP </a></li> -->
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="sitemap.php">Sitemap</a></li>
                  </ul>
                  </div>
                  <div class="col-sm-4 col-md-3 item" style="color: #f8f8f8;">
                   This website is a property of a consultancy firm, providing consultancy services w.r.t. fastag. We expressively declare that we are private consultants. We have no relation or we do not represent any government official or any government department such as fastag department, etc.
                  </div>
                  <div class="col-lg-3 item social"><a href="#"><img src="../assets/img/Facebook-logo.png" style="width: 80px;" alt="Facebook Logo"></img></a><a href="#"><img src="../assets/img/Gmail-logo.png" style="width: 80px;" alt="Gmail Logo"></img></a></a>
                      <p class="copyright">toll taxes</p>
                  </div>
              </div>
          </div>
      </footer>
  </div>

      <script>
      //jquery
      $(document).ready(function() {
              // Transition effect for navbar
              $(window).scroll(function() {
                if($(this).scrollTop() > 400) {
                    $('.nav-wrap').addClass('solid');
                } else {
                    $('.nav-wrap').removeClass('solid');
                }
              });
              $("#apply_insted_toggle").click(function(){
                 $("#apply_insted").show();
                 $("#apply_insted").addClass( "apply_insted_anime" )
              });
      });
      </script>



	</body>

</html>
