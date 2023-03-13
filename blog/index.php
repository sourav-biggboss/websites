<?php
$current_url = strtoupper($_SERVER['SERVER_NAME']);
require("../config.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Blogs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
  <style>
    p {
      text-transform: none !important;
    }
  </style>
  <style>
    /* Header/Blog Title */
    .header {
      padding: 30px;
      font-size: 40px;
      text-align: center;
      background: white;
    }

    /* Create two unequal columns that floats next to each other */
    /* Left column */
    .leftcolumn {
      margin: 0 0 15px;
      width: 80%;
    }



    /* Fake image */
    .fakeimg {
      width: 100%;
      margin: 0 0 15px;
      height: 430px;
      border: 1px solid #ddd;
    }

    /* Add a card effect for articles */
    .card {
      background-color: white;
      padding: 20px;
      margin-top: 20px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Footer */
    .footer {
      padding: 20px;
      text-align: center;
      background: #ddd;
      margin-top: 20px;
    }

    .vediv {
      padding: 20px;
      font-weight: bold;
      text-align: left;
      color: white;
      background-color: #92230f;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 800px) {

      .leftcolumn,
      .rightcolumn {
        width: 100%;
        padding: 0;
      }
    }

    .w3-leftbar {
      border-left: 6px solid #ccc !important;
    }

    .w3-light-grey,
    .w3-hover-light-grey:hover,
    .w3-light-gray,
    .w3-hover-light-gray:hover {
      color: #000 !important;
      background-color: #f1f1f1 !important;
    }

    .w3-panel {
      margin-top: 16px;
      margin-bottom: 16px;
    }

    .btn.btn-default {
      background-color: rgba(255, 255, 255, 0.5);
      border-color: #f1484a;
      color: #f1484a;
    }
  </style>

</head>

<body>
  <?php include("header.php"); ?>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/img/FasTag_3003.webp" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/img/fastag-banner.webp" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row mt-1">
      <marquee class="py-2" attribute_name="attribute_value" ....more="" attributes="" style="color: red;background-color: #ddd;">
        You agree to respect our terms of service, returns, and privacy policy by using this website. This website is owned and managed by an undertaking of private consultancy. Please give us an email to info@tolltaxes.com for other help and
        assistance.
      </marquee>
    </div>
  </div>
  <style>
    @media (min-width: 576px) {
      .card-deck .card {
        flex: auto;
      }
    }

    @media (min-width: 576px) {
      .card-deck .card {
        flex: auto;
      }

      .card-w {
        width: 18rem;
      }
    }
  </style>
  <div class="container">
    <div class="card-deck">
      <?php
    $views="";
    // $views=$_SESSION['views'] = $_SESSION['views']+1; ;
    $limit = 5;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page= 1;
    };
    $start_from = ($page-1) * $limit;
    $result = mysqli_query($conn, "SELECT * FROM `blogs`  WHERE `website_name` = '$current_url' ORDER BY `views` DESC LIMIT $start_from, $limit");
    $i=0;
    while ($row = mysqli_fetch_array($result)) {
        ?>
      <a href="<?php echo $row['page_name']; ?>" style="color:#000;text-decoration:none">
        <div class="card rounded-0 p-0 card-w">
          <div class="card-body" style="box-shadow: 0px 0px 15px 0px rgb(0 0 0 / 14%);">
            <h5 class="card-title  mt-0"><?php echo $row['title']; ?></h5>
            <img class="card-img mb-3" src="<?php echo $row['image']; ?>" alt="Card image cap">
            <p class="card-text"><?php echo $row['short_desc']; ?></p>
            <div><span class="float-left" style="color:gray;"><?php echo $row['created_date']; ?></span><a href="<?php echo $row['page_name']; ?>" class="btn float-right cta text-uppercase rounded-0">READ MORE</a></div>
          </div>
        </div>
      </a>

      <?php
    }
?>
    </div>
    <?php

$result_db = mysqli_query($conn, "SELECT COUNT(id) FROM `blogs`");
$row_db = mysqli_fetch_row($result_db);
$total_records = $row_db[0];
$total_pages = ceil($total_records / $limit);
/* echo  $total_pages; */
$pagLink = "<ul class='pagination justify-content-center mt-3'>";
for ($i=1; $i<=$total_pages; $i++) {
    $pagLink .= "<li class='page-item'><a class='page-link rounded-0' href='./?page=".$i."' style='border: 0;color: #fff;background-color: #225643; padding: 9px 20px;'>Next Page >></a></li>";
}
echo $pagLink . "</ul>";
?>
  </div>
  <?php
    include("footer.php");
?>
</body>

</html>