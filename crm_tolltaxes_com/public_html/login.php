<!DOCTYPE html>
<html>
<head>
<title>CRM</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>

<form method="post" action="">
  <div class="container">
    <h1>Login</h1>
    <p>Please login to continue to crm.</p>
    <?php
    if ((isset($_POST["email"]))&&(isset($_POST["password"]))) {
      require_once("config/db.php");
      require("class/login.inc.php");
      if (!login_user($_POST["email"],$_POST["password"], $conn)) {
        include("views/login-incorrect-pwd-alert.html.php");
      }else {
        header("Location: dashboard.php");
      }
      // echo login_user($_POST["email"],$_POST["password"], $conn);
    }
    ?>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>
    <hr>
    <p>By login you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn w3-teal">login</button>
  </div>
</form>

</body>
</html>
