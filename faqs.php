<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frequently Asked Question and Answer (FAQ) on Fastag</title>
    <meta name="description" content="Get all commonly frequently asked questions answered on fastag in our faq page. Checkout our page for all fastag related queries!">
<?php include"header.php";?>
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
  .accordion {
    padding: 0px 110px;
  }
  @media only screen and (max-width: 600px) {
  .accordion {
    padding-left: 18px;
    padding-right: 18px;
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

  .accordion__title.active {
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
	<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
     		    <div class="carousel-item active">
     		      <img src="./assets/img/FasTag_3003.webp" class="d-block w-100" alt="...">
     		    </div>
     		    <div class="carousel-item">
     		      <img src="./assets/img/fastag-banner.webp" class="d-block w-100" alt="...">
     		    </div>
       </div>
</div>
<div class="container-fluid">
<div class="row mt-1">
    <marquee class="py-2" attribute_name="attribute_value" ....more="" attributes="" style="color: red;background-color: #ddd;">
    You agree to respect our terms of service, returns, and privacy policy by using this website. This website is owned and managed by an undertaking of private consultancy. Please give us an email to info@tolltaxes.com for other help and assistance.
    </marquee>
</div>
</div>
		<div class="faqstitle">
			<h1 style="text-align: center; margin-top: 50px; margin-bottom: 50px;">Frequently Asked Question And Answer FASTag faq</h1>
		</div>
		<div class="container-fluid p-0">
         <div class="accordion">
        <?php
					$web = strtoupper($_SERVER['SERVER_NAME']);
					include("admin/crm_db_conn.php");
					// to crm db
					$connect = new mysqli($crm_servername, $crm_username, $crm_password, $crm_dbname);
					if ($connect->connect_error) {
					die("Connection failed: " . $connect->connect_error);
					}
					
					$sql = "SELECT `id`,`question`,`answers` FROM `insert_faqs` WHERE `website_name` = '$web' ORDER BY `views` DESC";
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
</div>

        <?php include'footer.php';?>

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
			function add_views_faqs(id){$.get("admin/add-views-faqs.php?id="+id, function(data, status){});}
			</script>
	</body>
	</html>
