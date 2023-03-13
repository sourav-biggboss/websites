
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">

</head>
<body>
<div class="nav-wrap">
		<div id="nav-icon" onclick="w3_open()"></div>
    <div class="logo">
      <a href="/"><img src="/assets/img/fastag-nav-logo.webp" alt="FasTag Logo"></a>
    </div>
		<div id="top-nav">
			<ul class="menu">
				<li style="border-right: 2px solid #f8f8f8;"><a href="/">HOME</a></li>
				<li style="border-right: 2px solid #f8f8f8;"><a href="/">FASTAG REGISTRATION</a></li>
				<li style="border-right: 2px solid #f8f8f8;"><a href="/fastag-recharge.php">FASTAG RECHARGE</a></li>
				<li style="border-right: 2px solid #f8f8f8;"><a href="/enquiry.php">ENQUIRY</a></li>
				<li style="border-right: 2px solid #f8f8f8;"><a href="/faqs.php">FAQs</a></li>
				<li style=""><a href="/blog">BLOG</a></li>
			</ul>
		</div>
        <div class="googe_searchbar text-white text-center my-auto">
        
            </div>
        	</div>
  <!-- Sidebar -->
  <div class="w3-sidebar w3-bar-block w3-border-right text-muted" style="display:none;width:0;" id="mySidebarfast">
    <span   class="w3-bar-item w3-large"><b>Menu</b><span onclick="w3_close()"style="float: right;" >&times;</span></span>
    <a href="/" class="w3-bar-item w3-button text-decoration-none">HOME</a>
    <a href="/" class="w3-bar-item w3-button text-decoration-none">FASTAG REGISTRATION</a>
     <a href="/fastag-recharge.php" class="w3-bar-item w3-button text-decoration-none">FASTAG RECHARGE</a>
    <a href="/enquiry.php" class="w3-bar-item w3-button text-decoration-none">ENQUIRY</a>
    <a href="/faqs.php" class="w3-bar-item w3-button text-decoration-none">FAQs</a>
    <a href="/blog" class="w3-bar-item w3-button text-decoration-none">BLOG</a>
    <!--<a href="./complaint-form.php" class="w3-bar-item w3-button text-decoration-none">COMPLAINT</a>-->
    <!--<a href="./complaint-track-form.php" class="w3-bar-item w3-button text-decoration-none">TRACK COMPLAINT</a>-->
  </div>
<script>
function w3_open() {
  document.getElementById("mySidebarfast").style.display = "block";
  document.getElementById("mySidebarfast").style.width = "auto";
}

function w3_close() {
  document.getElementById("mySidebarfast").style.display = "none";
  document.getElementById("mySidebarfast").style.width = "0";
}
</script>

