<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Fastag Apply Online in India - TollTaxes.com</title>
 <meta name="description" content="Want a Fastag card?  If yes then you can easily apply for it by ﬁlling a simple fastag online registration form at tolltaxes.com in just 5 minutes.">
 <meta name="keywords" content="apply fastag online, fastag apply online, fastag online apply, fastag portal, online fastag portal, fastag, online fastag, toll tax, online toll tax, online apply for toll tax, toll tax online apply, fastag near me, sbi fastag, hdfc fastag, icici fastag, paytm fastag,best fastag card airtel fastag">

<?php include"header.php";?>

<body>
<style>
.fchd {
        padding: 5px;
        text-align: center !important;
        background: #343a40;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 18px;
    }
     @media only screen and (max-width: 600px) {
    #enquiryform_popup{
        font-size:11px!important;
    }
     }

</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
          <div class="title_trnsparant"><h2 class="heading_apply">APPLY INSTANT FOR FASTAG</h2><p style="text-align: center;font-weight: 100;margin: 0;color:#fff;font-size: 18px;" id="enquiryform_popup" >Want instant fastag !! Apply now for free</p><p class="apply-insted-btn"><input type="tel" maxlength="10" name="search" id="apply_insted" class="apply_insted" id="apply_insted" placeholder="Enter Mobile Number" style="border-radius: 5px;"><button id="apply_insted_toggle" class="blob-btn blob-btn--hyperion">Instant Apply</button></p></div>
		      <div class="d-block w-100 minhig" alt="..." style="background: linear-gradient( 169deg, #20b2aa 0%, #fe4601 100%);">
		    </div>
		  </div>
		</div>
    <script>
  $(document).ready(function(){
      let runajaxinsted = 0 ;
    $("#apply_insted_toggle").click(function(){
      if(runajaxinsted == 1){$("#apply_insted_toggle").text('PLEASE WAIT..');
      //console.log("../enquiry.php?applicant_name="+$("#fname").val()+"&mobile_number="+$("#lname").val()+"&email_id="+$("#email_id").val()+"&form_name=Passport Enquiry&form_id=passport_enquiry&sub=''");
     $.get("submit.php?mobile_number="+$("#apply_insted").val()+"&form_name=Fastag Insted&form_id=fastag_insted&sub1=submit",function(data,status){
      $("#enquiryform_popup").html(data);
      $("#apply_insted_toggle").html('Done');
    });}else {
      runajaxinsted = 1 ;}
   });

  });
  </script>
  <div class="container-fluid">
<div class="row mt-1">
    <marquee class="py-2" attribute_name="attribute_value" ....more="" attributes="" style="color: #fc4703;background-color: #ddd;">
    You agree to respect our terms of service, returns, and privacy policy by using this website. This website is owned and managed by an undertaking of private consultancy. Please give us an email to info@tolltaxes.com for other help and assistance.
    </marquee>
</div>
</div>

		<div class="container p-4 p-xl-3" style="background: #fff">
      <div class="row">
        <?php
        function isMobileDevice() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }
        if(!isMobileDevice()){
          echo '<div class="col-md-4  mb-4" >
          <img src="./assets/img/fastag-form.webp" style="width: 330px;height: 1050px;">
         </div>';
        }
        ?>
        <div class="col-md-8  mb-8" >
        <form id="form-log" action="submit.php" method="post" enctype="multipart/form-data" class="form-sec" style="width:100%!important">
          <div class="row">
            <div class="col-md-10  mb-3 mt-2" ><h6 style="margin: 6px 0px;font-size: 48px;color:#225643!important;font-weight: 600;">Apply For FASTag Online</h6></div>
          </div>
            <div class="form-row mb-2">
                <div class="col-md-6  mb-6">
                  <label for="validationServer01">First name <span>(*)</span> </label>
                  <input type="text" class="form-control" maxlength="32" pattern="[A-Za-z]{1,32}" placeholder="Enter Your First name" name="applicant_name" oninvalid="this.setCustomValidity('Invalid First Name!')" oninput="this.setCustomValidity('')" required>
                </div>
                <div class="col-md-6  mb-6">
                  <label for="validationServer01">Last name <span>(*)</span> </label>
                  <input type="text" class="form-control" maxlength="32" pattern="[A-Za-z]{1,32}" placeholder="Enter Your Last name" name="last_name" oninvalid="this.setCustomValidity('Invalid Last number!')" oninput="this.setCustomValidity('')" required>
                </div>
              </div>
              <div class="form-row  mb-2">
                <div class="col-md-6 mb-6">
                  <label for="validationServer02">Mobile number <span>(*)</span></label>
                  <input type="tel" maxlength="10" class="form-control" placeholder="Enter Your Mobile number" name="mobile_number" oninvalid="this.setCustomValidity('Invalid Mobile Number!')" oninput="this.setCustomValidity('')" required>
                </div>
                <div class="col-md-6  mb-6">
                  <label for="validationServer01">Email id <span>(*)</span></label>
                  <input type="email" class="form-control" placeholder="Enter Your Email id" name="email_id" oninvalid="this.setCustomValidity('Invalid Email Id!')" oninput="this.setCustomValidity('')" required>
                </div>
              </div>

              <div class="form-row  mb-2">
                <div class="col-md-6 mb-6">
                    <label>Mother's name <span>(*)</span></label>
                    <input type="text" class="form-control" maxlength="32" pattern="[A-Za-z]{1,32}" placeholder="Enter Your Mother's name" name="mothers_name" oninvalid="this.setCustomValidity('Invalid Name!')" oninput="this.setCustomValidity('')" required>
                </div>

                <div class="col-md-6 mb-6  mb-2">
                    <label>Date of birth <span>(*)</span></label>
                    <input type="text" class="form-control" placeholder="Date of birth (DD/MM/YYYY)" size="10" maxlength="10" onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1/$2').replace(/^(\d\d\/\d\d)(\d+)$/g,'$1/$2').replace(/[^\d\/]/g,'')" name="date_of_birth" oninvalid="this.setCustomValidity('Invalid Date Of Birth!')" oninput="this.setCustomValidity('')" required>
                </div>
            </div>


            <div class="form-row  mb-2">
                <div class="col-md-6 ">
                  <label>Vehicle registration number <span>(*)</span></label>
                  <input type="text" class="form-control"  placeholder="Enter Your Vehicle registration number" name="vehicle_registration_number" oninput="this.setCustomValidity('')" required>
                </div>
                <div class="col-md-6 ">
                  <label>Chassis number <span>(*)</span></label>
                  <input type="text" class="form-control" placeholder="Enter Your Chassis number" name="chassis_number"  required>
                </div>
              </div>

                <div class="form-row  mb-2">
              <div class="col-md-6">
                  <label>Gender <span>(*)</span></label>
                  <select class="form-control" name="gender" required>
                      <option value="">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
              </div>
                <div class="col-md-6 ">
                  <label>PAN number <span>(*)</span></label>
                  <input type="text" class="form-control" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" placeholder="Enter Your PAN number" oninvalid="this.setCustomValidity('Invalid PAN Number!')" oninput="this.setCustomValidity('')" name="pan_number" required>
                </div>
            </div>
            <div class="form-row  mb-0">
                <div class="col-md-4  mb-3" style="display:none">
                  <label for="validationServer01">Flat number</label>
                  <input type="text" class="form-control" placeholder="Flat No." id="validationServer01" name="flat_number">
                </div>
                <div class="col-md-4 mb-3"style="display:none">
                  <label for="validationServer02">Building name</label>
                  <input type="text" class="form-control" placeholder="Building" id="validationServer02" name="building_name">
                </div>
                <div class="col-md-4  mb-3"style="display:none">
                  <label for="validationServer01">Street name</label>
                  <input type="text" class="form-control" placeholder="Street" name="street_name" id="validationServer01">
                </div>
              </div>

              <div class="form-row  mb-2">
              <div class="col-md-6">
                  <label>City <span>(*)</span></label>
                  <input type="text" pattern="[A-Za-z0-9]+" class="form-control" placeholder="Enter Your City" oninvalid="this.setCustomValidity('Invalid City!')" oninput="this.setCustomValidity('')" name="city" required>
                </div>
                <div class="col-md-6">
                  <label>State <span>(*)</span></label>
                  <select id="office-state" class="form-control" name="office_state" onchange="makeSubmenuOffice(this.value)" required>
                                <option value="">Select State</option>
                                <option value="Andhra_Pradesh">Andhra_Pradesh</option>
                                <option value="Arunachal_Pradesh">Arunachal_Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadara">Dadara</option>
                                <option value="Daman">Daman</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal_Pradesh">Himachal_Pradesh</option>
                                <option value="Jammu_and_Kashmir">Jammu_and_Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya_Pradesh">Madhya_Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil_Nadu">Tamil_Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar_Pradesh">Uttar_Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West_Bengal">West_Bengal</option>
                            </select>
                </div>
              </div>
              <div class="form-row  mb-2">
                <div class="col-md-6">
                  <label>District <span>(*)</span></label>
                  <select class="form-control" name="office_district" id="office-district" required>
                                <option value="" selected="selected">Please select District</option>
                            </select>
                </div>
                <div class="col-md-6 ">
                  <label>Pin code <span>(*)</span></label>
                  <input type="tel" class="form-control" placeholder="Enter Your Pincode" name="pincode" maxlength="6" oninvalid="this.setCustomValidity('Invalid PIN Number!')" oninput="this.setCustomValidity('')" required>
                </div>
              </div>


         <div class="row  mb-2">
           <div class="col-md-6">
           <label>Shipping Address </label>
             <textarea class="form-control"name="shipping_address" placeholder="Enter Shipping Address" oninvalid="this.setCustomValidity('Invalid Address!')" oninput="this.setCustomValidity('')" required></textarea>
           </div>
         	<div class="col-md-6">
         		<label for="file-upload">UPLOAD REGISTRATION CERTIFICATE <span>(*)</span></label>
         		<label class="add-upload-btn rounded-0">Registration Certificate (RC Of Vehicle)
	                <span>
	                	<input type="file" name="upload_rc" required>
	                </span>
            		</label>
         	</div>
         </div>

        <div class="row  mb-2">

          <div class="col-md-6">
            <label for="file-upload">UPLOAD AADHAAR CARD / VOTER ID / DRIVING LICENSE / PASSPORT <span>(*)</span></label>
            <label class="add-upload-btn rounded-0" require>AADHAAR CARD / VOTER ID / DRIVING LICENSE / PASSPORT
                  <span>
                    <input type="file" name="upload_aadhaar_voter_dl_passport" required>
                  </span>
                </label>
          </div>
          <div class="col-md-6">
         		<label for="file-upload">UPLOAD PAN CARD <span>(*)</span></label>
         		<label class="add-upload-btn rounded-0">PAN CARD
	                <span>
	                	<input type="file" name="upload_pan_card" required>
	                </span>
            		</label>
         	</div>
         </div>


          <input type="hidden" name="form_name" value="FASTAG Form">
          <input type="hidden" name="form_id" value="fastag_form">
             <div class="row">
            <div class="col-md-6">
            <input type="checkbox" name="terms_of_service" required="">
                        <label class="form-check-label">I AGREE TO THE <a href="./terms-and-condition.php">TERMS OF SERVICE</a> </label>

             </div>
             </div>

             <div class="row pt-6">
            <div class="col-md-6 mt-6">
            <span>Note: Order placed by you will be non-cancellable in any circumstances.</span>
             </div>
             </div>

          <div class="row">

            <div class="col-md-3">
            	<div class="buttons-div">
              	<input type="submit" name="submit-butt" value="SUBMIT" class="cta rounded-0">
            	</div>
            </div>
          </div>
        </form>
      </div>
        </div>
      </div>
<div class="container-fluid p-0" style="background: #fff">
		<div class="container mt-5">
      <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar what-we-do-sidebar">
                    <h4>FASTag</h4>
                    <ul class="open-sidebar">
                        <li><a href="#">Product Overview</a></li>
                        <li><a href="#">NETC FASTag Brand Guidelines</a></li>
                        <li><a href="#">Live Members</a></li>
                        <li><a href="#">Steering Committee</a></li>
                        <li><a href="#" style="    padding-bottom: 0;">Product Statistics</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-9">

                <div class="mb-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                  <source src="/assets/video/How to get your FASTag_1080p.mp4" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="embed-responsive embed-responsive-16by9">
                                <video width="100%" height="100%" controls>
                                  <source src="/assets/video/What’s FASTag _ How does it help.mp4" type="video/mp4">
                                </video>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

          <div id="intro" class="basic-1">
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-5">
                              <div class="text-container">

                                  <h3>What is FASTag ?</h3>
                                  <p style="font-size: 19px;">Fastag system was ﬁrst introduced by the government of India in 2014, between the
Ahmedabad and Mumbai highway and later it was made mandatory for every toll plaza in the country.<br>
Fastag is the Radio-Frequency Identiﬁcation (RFID) technology based toll payment system in which there is no requirement of cash for toll payments. It automatically collects payment through the fastag sticker attached on the vehicle front screen.
                                    </p>


                              </div> <!-- end of text-container -->
                          </div>
                          <div class="col-lg-7">
                              <div class="image-container">
                                  <img class="img-fluid rounded-0" src="assets/img/What-is-FASTag.webp" alt="alternative">
                              </div> <!-- end of image-container -->
                          </div>
                      </div> <!-- end of row -->
                  </div> <!-- end of container -->
              </div>
              <div id="intro" class="basic-1">
                      <div class="container">
                          <div class="row">
                            <div class="col-lg-7">
                                <div class="image-container">
                                    <img class="img-fluid rounded-0" src="assets/img/apply-fastag.webp" alt="alternative">
                                </div> <!-- end of image-container -->
                            </div>
                              <div class="col-lg-5">
                                  <div class="text-container">

                                      <h3>How does Fastag Work?</h3>
                                      <p>
                                      <p style="font-size: 19px;">When you apply for the Fastag then you will get the Radio-Frequency Identiﬁcation (RFID) enabled sticker which needs to be placed on the vehicle windscreen or the front screen.<br><br>
This system is made in such a way that when your vehicle passes from the toll plaza, it will automatically detect the fastag sticker from your vehicle windscreen and automatically deduct  the toll payment charges from the account which is linked with your Fastag account
                                    </p>


                                  </div> <!-- end of text-container -->
                              </div>
                          </div> <!-- end of row -->
                      </div> <!-- end of container -->
                  </div>
                   <div id="intro" class="basic-1">
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-5">
                              <div class="text-container">

                                  <h3>Is it mandatory to have a Fastag Card?</h3>
                                  <p style="font-size: 19px;">FYes from 15th October 2021, the Ministry of Road Transportation and Highway has made Fastag mandatory for every vehicle passing the toll plaza.<br>
It is strictly advised for all the toll plaza in India to adopt this new Fastag mechanism that works on RFID technology.
                                    </p>


                              </div> <!-- end of text-container -->
                          </div>
                          <div class="col-lg-7">
                              <div class="image-container">
                                  <img class="img-fluid rounded-0" src="assets/img/is-it-required-to-hv-a-fastag-card.webp" alt="alternative">
                              </div> <!-- end of image-container -->
                          </div>
                      </div> <!-- end of row -->
                  </div> <!-- end of container -->
              </div> 
                <div id="intro" class="basic-1">
                      <div class="container">
                          <div class="row">
                            <div class="col-lg-7">
                                <div class="image-container">
                                    <img class="img-fluid rounded-0" src="assets/img/advantages-of-fastag.webp" alt="alternative">
                                </div> <!-- end of image-container -->
                            </div>
                              <div class="col-lg-5">
                                  <div class="text-container">

                                      <h3>Beneﬁts of having Fastag Card?</h3>
                                      <p>
                                           <ul  style="font-size: 19px;">
                                             <li>There are lots of beneﬁts of having Fastag card:</li>
                                             <li> Cashless transaction</li>
                                            <li> Saves fuel & time.</li>
                                           <li> Easy online Recharge</li>
                                           <li> SMS alert for every transaction</li>
                                           <li> Monthly pass for regular passing.</li>
                                           </ul>
                                          </p>


                                  </div> <!-- end of text-container -->
                              </div>
                          </div> <!-- end of row -->
                      </div> <!-- end of container -->
                  </div>
                        <div id="intro" class="basic-1">
                          <div class="container">
                              <div class="row">
                                  <div class="col-lg-5">
                                      <div class="text-container">

                                          <h3>Process for Fastag Registration Online</h3>
                                          <p>
                                           <ul  style="font-size: 19px;">
                                             <li>Follow the below steps for fastag registration:card:
</li>
                                             <li>First ﬁll the Fastag online form given above</li>
                                            <li>Upload the required documents.</li>
                                           <li>Make secure online payment  for your application.</li>
                                           <li>Our executive will process your application.</li>
                                           <li>Get your Fastag card within a few working days.</li>
                                           </ul>
                                          </p>


                                      </div> <!-- end of text-container -->
                                  </div>
                                  <div class="col-lg-7">
                                      <div class="image-container">
                                          <img class="img-fluid rounded-0" src="assets/img/process-for-fastag-reg-online.webp" alt="alternative">
                                      </div> <!-- end of image-container -->
                                  </div>
                              </div> <!-- end of row -->
                          </div> <!-- end of container -->
                      </div>
                      
                      
</div>
<style>
  .accordion {
    padding: 0px 110px;
  }
  @media only screen and (max-width: 600px) {
  .accordion {
    padding-left: 12px;
    padding-right: 12px;
  }
}

  .accordion__item {
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #f2f2f2;
    border-radius: 4px;
    box-shadow: 0px 0px 15px 0px rgb(0 0 0 / 6%);
  }

  .accordion__title {
    margin-top: 0;
    font-size: 18px;
    cursor: pointer;
    margin-bottom: 0;
    position: relative;
  }


  .accordion__title:after {
    content: "";
    width: 20px;
    height: 20px;
    position: absolute;
    right: 0;
    top: 0;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABlUlEQVRIS72V6zEEQRSFv81ABogAESADIiADRIAIEAEiQASIABmQgQyor+rerZ7enp71Y92qqZrpxznnPmfGim22YnyWITgGdoHteNT0Hs8j8NQT2SM4AK6AjQkvP4EzQLIFGyO4Bk7i9Bfg90uodllv9oBTYD3OeUaigbUISnAv+N0zSfRUuwnS+fmawLA8xO5OoXiqFvToLQ4dluGqCYynLi+jvCZNT8TYzM2SwGq5BYz5VGLHPEqBcy9KgjvgqFJ/ETn4HkFci2K4jP304h5Q8KAPrO0tIGMv+HnkYR+oSQR/joqSwPOZC7HEGRD8hIr0SgBLU1IvlCQl+EeUbAoY4JQhqgnka5G4nsprcPdGCeoQZdhrkmy0FniGyD3fByFqJblF4loL3PVukrPJBnVcVE964pJjolVZ3TL14lSjSaK1wFP9oI/+fVSorhx2qnKA9exPwy6BShLD5vdrNa79CQmeY2VhktZVVKs06QLnvB/zwphL9KcfTgkmkY91bVdnmdo3gjaBE2CZf/JECvrbKyf4BdpXaxkir2UhAAAAAElFTkSuQmCC) no-repeat;
    background-size: 20px;
  }

  .accordion__title.active:after {
    transform: rotate(-180deg);
  }

  .accordion__title:hover, .accordion__title.active {
    color: #FF4500;
  }

  .accordion__body {
    display: none;
    padding-top: 10px;
  }

  .accordion__body p {
    margin-bottom: 0;
  }
</style>
<div class="container-fluid p-0" >
         <div class="accordion">
			    	<h4 style="font-size: 31px;margin: 20px 0 20px 0;">Faqs section</h4>
        <?php
					$web = strtoupper($_SERVER['SERVER_NAME']);
					include("admin/crm_db_conn.php");
					// to crm db
					$connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
					if ($connect->connect_error) {
					die("Connection failed: " . $connect->connect_error);
					}
					
					$sql = "SELECT `id`,`question`,`answers` FROM `insert_faqs` WHERE `website_name` = '$web' ORDER BY `views` DESC LIMIT 4";
					$result = $connect->query($sql);
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '
					  <div class="accordion__item">
                      <h2 class="accordion__title">'.$row['question'].'</h2>
                      <div class="accordion__body">
                        <p>'.$row['answers'].'
                        </p>
                      </div>
                    </div>';
					}
					} else {
					  echo '
					  <div class="accordion__item">
                      <h2 class="accordion__title active">0 result found</h2>
                      <div class="accordion__body">
                        <p>0 result found
                        </p>
                      </div>
                    </div>';
					}
					?>
</div>
<?php
$current_url = strtoupper($_SERVER['SERVER_NAME']);
 $result = mysqli_query($connect,"SELECT * FROM insert_blog WHERE `website_name` = '$current_url'  ORDER BY views DESC LIMIT 4");
if ($result->num_rows > 0) {
    echo '<div class="accordion mt-5">';
  echo '<div class="row">';
  while($row = mysqli_fetch_array($result)) {
  ?>
  <div class="col-lg-3">
   <a href="<?php echo $row['page_url']; ?>"style="color:#000;text-decoration:none">
   <div class="card rounded-0 p-0">
     <div class="card-body">
       <h5 class="card-title  mt-0"><?php echo $row['title']; ?></h5>
       <img class="card-img mb-3" src="<?php echo $row['image']; ?>" alt="Card image cap">
       <p class="card-text"><?php echo urldecode($row['description']); ?></p>
       <div><span class="float-left" style="color:gray;"><?php echo $row['form_created_on']; ?></span><a href="<?php echo $row['page_url']; ?>" class="btn float-right cta text-uppercase rounded-0">READ MORE</a></div>
     </div>
   </div>
   </a>
 </div>
   <?php
  }
  echo '</div></div>'; 
}
?>

</div>
<script>
$(".accordion__title.active").next().slideDown();
$(".accordion__title").on("click", function() {
  if ($(this).hasClass('active')) {
    $(this).removeClass("active").next().slideUp();
  } else {
    $(".accordion__title.active").removeClass("active").next(".accordion__body").slideUp();
    $(this).addClass('active').next('.accordion__body').slideDown();
  }
});
</script>
		<?php include'footer.php';?>
<script src="state.js"></script>
</body>

</html>
