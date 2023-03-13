<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fastag Registration - Complaint Form</title>
  <meta name="description" content="Submit your complaint and Udyam-related issues in the Udyam complaint registration form and get an expert response. ">
    <link rel="icon" href="./assets/img/flag.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/main.css">

    <style>
        .container-fluid.fcs-padding-container {
            background: #ffffff !important;
        }
        form {

          background: #fff;
          padding: 15px;
          height: 85% !important;
        }

        .fchd {
          background: #225643 !important;
          color: white;
          font-weight: bold;
          font-size: 14px;
          padding: 10px;
          margin: 0;
        }
        .fcs-form-container {
    padding-top: 100px;
}

.form-complat {
    background-color: #cc6900!important;
    padding: 10px 0;
    font-size: 18px;
}
    </style>
</head>
<body>
    <?php include_once('./header.php'); ?>
    <script src="https://tolltaxes.com/assets/js/custom-google-search-input.js"></script>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    		  <div class="carousel-inner">
    		    <div class="carousel-item active">
              <div class="title_trnsparant"><h1 class="heading_apply">APPLY INSTANT FOR FASTAG</h1><p style="text-align: center;margin: 0;" id="enquiryform_popup"></p><p class="apply-insted-btn"><input type="tel" maxlength="10" name="search" id="apply_insted" class="apply_insted" id="apply_insted" placeholder="Enter Your Mobile Number" style="border-radius: 7px;"><button id="apply_insted_toggle" class="blob-btn blob-btn--hyperion">Instant Apply</button></p></div>
    		      <img src="./assets/img/FasTag_3003.jpg" class="d-block w-100 minhig" alt="...">
    		    </div>
    		  </div>
    		</div>
    <div class="container fcs-form-container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 offset-0" style="box-shadow: 0 10px 16px 0 rgb(0 0 0 / 10%), 0 6px 20px 0 rgb(0 0 0 / 9%) !important;padding: 0;">
                <h1 class="container-fluid fchd text-center text-uppercase form-complat">Complaint Form</h1>
                <form id="main-form" action="complaint-submit.php" method="post" name="complaint" onsubmit="return checkform()">
                      <div class="form-group txt">
                        <label>ENTER YOUR ORDER ID <span class="required text-danger">(Required)</span></label>
                        <input type="text" class="form-control" name="order_id" value="">
                    </div>
                    <button type="submit"name="submit" class="bttn inline-btn">Submit Complaint</button>
                </form>
            </div>
        </div>
    </div>
<script>
    function checkform() {
        var name = document.forms["complaint"]["order_id"];
        if (name.value == "") {
            window.alert("Please enter your order id.");
            name.focus();
            return false;
        }
        return true;
    }
</script>
    <?php include_once('./footer.php'); ?>
</body>
</html>
