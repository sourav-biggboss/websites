<?php
if ((isset($_POST['otp']))&&(isset($_POST['form_id']))) {
  include("admin/crm-otp.php");
  if(crm_otp($_POST['otp'],$_POST['form_id'])){
    echo "<script>window.alert('OTP has been successfully submitted!')</script>";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp for Fastag Online | tolltaxes.com</title>
    <meta name="description" content="Be a part of our exclusive fastag franchise dealership. Contact us by filling up the below form.">
<?php include"header.php";?>
<style>
@media (max-width: 780px) {
.rescon{
 max-width:100%!important;
}
}
</style>
<body>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner">
   		    <div class="carousel-item active">
   		      <img src="./assets/img/FasTag_3003.jpg" class="d-block w-100" alt="...">
   		    </div>
   		    <div class="carousel-item">
   		      <img src="./assets/img/fastag-banner.png" class="d-block w-100" alt="...">
   		    </div>
       </div>
     </div>
		<div class="container">

<p></p><p></p>

<div class="container p-0 rescon"   style=" max-width: 32.2222222%;     box-shadow: 0 5px 10px 0 rgba(0,0,0,0.2),0 5px 10px 0 rgba(0,0,0,0.2) !important;">
<h5 class="fchd text-center text-white" style="background:#ffb938;    position: relative;  width: 100%;  padding-right: 0 !important;padding-left: 0 !important;padding-top: 10px;padding-bottom: 10px;">Fill the OTP</h5>
<form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="" style="    margin-bottom: 25px;">
<br>
<div class="form-group col-lg-12 txt">
<label>Enter OTP   <span class="required">*</span> </label>
<input type="text" name="otp" class="form-control" required="">
</div>
<input type="hidden" name="form_id" value="<?php echo $_GET['id']; ?>" class="form-control" required="">
<button type="submit" class="btn ml-3 mb-4 ssfg" style="background-color:#225643;color:#fff;transition: background-color 0.3s ease-in!important;"name="submit">SUBMIT</button>
</form>
</div>





		</div>

		<?php include'footer.php';?>
</body>

</html>
