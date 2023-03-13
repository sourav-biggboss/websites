<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FASTAG ONLINE</title>
  <link rel="icon" href="./assets/img/flag.png" type="image/gif" sizes="16x16">
  <script src="https://kit.fontawesome.com/d23a55b7f1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    input.razorpay-payment-button {
      display: none;
    }
.border-list > *:last-child {
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
    pointer-events: none !important;
    cursor: not-allowed !important;
}
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
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
  <form action="verify.php" method="POST" class="col-11" style="margin: auto; background: #ffffff; padding: 30px; padding-top: 65px;padding-bottom:0;">
    <span class="card-text">PLEASE WAIT WHILE REDIRECTING...</span>
    <script
      src="https://checkout.razorpay.com/v1/checkout.js"
      data-key="<?php echo $data['key']?>"
      data-amount="<?php echo $data['amount']?>"
      data-currency="INR"
      data-name="<?php echo $data['name']?>"
      data-image="<?php echo $data['image']?>"
      data-description="<?php echo $data['description']?>"
      data-prefill.name="<?php echo $data['prefill']['name']?>"
      data-prefill.email="<?php echo $data['prefill']['email']?>"
      data-prefill.contact="<?php echo $data['prefill']['contact']?>"
      data-notes.shopping_order_id="3456"
      data-order_id="<?php echo $data['order_id']?>"
      <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
      <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
    >
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="3457">
  </form>

  <script>
      document.querySelector('.razorpay-payment-button').click();
  </script>

  <?php include 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Custom JS -->
  <script src="./assets/js/nav.js"></script>
  <script src="./assets/js/util.js"></script>
  <script src="./assets/js/main.js"></script>
<?php
    function getUserIP() {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        }
        else {
            $ip = $remote;
        }
        return $ip;
    }

    $ip = getUserIP();
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page =  basename($_SERVER['PHP_SELF']);
  ?>
  <script>
    window.addEventListener("beforeunload", function (e) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              console.log(this.response);
          }
      };
      xhttp.open("GET", "track-ip.php?crm&ip=<?php echo $ip; ?>&url=<?php echo $url; ?>&status=false", true);
      xhttp.send();
    }, false);


    window.addEventListener("load", function (e) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              console.log(this.response);
          }
      };

      xhttp.open("GET", "track-ip.php?crm&ip=<?php echo $ip; ?>&url=<?php echo $url; ?>&user_id=<?php echo $_SESSION["panel_form_id"]; ?>&status=true", true);
      xhttp.send();
    }, false);


  </script>
</body>
</html>
