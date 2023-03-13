<?php
//config for db
require $_SERVER['DOCUMENT_ROOT']."/config.php";
$website = $_SERVER['SERVER_NAME'];
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$date = date('d-m-Y H:i:s');
//user id
$auther = "Admin";
//user pass
$pass_saved="freeDom@199#";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>BLog</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="blog.css">
</head>

<body style="background-color: #f8f9fa!important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">
        <div class="p-4">
          <h1>Blog</h1>
        </div>
        <ul class="list-group list-group-flush">
          <!-- side bar -->
          <li class="list-group-item"><a href="./?page=addBlog" class="text-decoration-none">Add Blog</a></li>
          <li class="list-group-item"><a href="./?page=editBlog" class="text-decoration-none">Edit Blog</a></li>
          <li class="list-group-item"><a href="./?page=overBlog" class="text-decoration-none">Over View</a></li>
          <li class="list-group-item"><a href="./?page=uploadFile" class="text-decoration-none">Upload file</a></li>
          <li class="list-group-item"><a href="/site-editor.php" class="text-decoration-none">Site Editor</a></li>
          <li class="list-group-item"><a href="/" class="text-decoration-none">Home</a></li>
          <li class="list-group-item"><a href="./userValidation.php" class="text-decoration-none">Log Out</a></li>
        </ul>
      </div>
      <div class="col-10 ">
        <?php
         //user Validatrion action
         if (isset($_COOKIE['userAuth']) && ($_COOKIE['userAuth'] == $pass_saved)) {
             //tabs
             if ((isset($_REQUEST['page'])) && ($_REQUEST['page'] == "addBlog")) {
                 include('addBlog.inc.php');
             } elseif ((isset($_REQUEST['page'])) && ($_REQUEST['page'] == "editBlog")) {
                 include('editBlog.inc.php');
             } elseif ((isset($_REQUEST['page'])) && ($_REQUEST['page'] == "overBlog")) {
                 include('overBlog.inc.php');
             } elseif ((isset($_REQUEST['page'])) && ($_REQUEST['page'] == "uploadFile")) {
                 include('uploadFile.inc.php');
             }
             //default page
             else {
                 include('addBlog.inc.php');
             }
         } else { ?>
        <!-- login form -->
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"><?php echo $_SERVER['SERVER_NAME']; ?></a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Login</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Login</h6>
          </nav>
          <div class="form mt-4 p-4">
            <!-- validation form -->
            <h1>Login</h1>
            <form action="userValidation.php" method="post">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">PIN</label>
                <input type="password" class="form-control" name="pin" required>
                <input type="hidden" name="login" value="login" required>
              </div>
              <button type="submit" class="btn btn-primary mb-2">Login</button>
            </form>
          </div>
        </div>

        <?php
         }

          ?>
      </div>
    </div>
  </div>


</body>

</html>
