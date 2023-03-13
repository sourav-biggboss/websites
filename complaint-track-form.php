<?php
include('./config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Track Complaint Form - Fastag Registration</title>
  <meta name="description" content="Track your online complaint via your complaint number in the Udyam registration complaint track from on the Udyam Registration website. ">
    <link rel="icon" href="./assets/img/flag.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./main.css">

    <style>
        .container-fluid.fcs-padding-container {
            background: #ffffff !important;
        }
        form {
            background: #eee;
            padding: 15px;
        }

        .fchd {
            background: #000;
           color:white;
        }

        .form-complat {
            background-color: #cc6900!important;
            padding: 10px 0;
            font-size: 18px;
        }
        .label-text{
            color: #000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include_once('./header.php'); ?>
<script src="http://localhost/assets/js/custom-google-search-input.js"></script>
    <div class="container fcs-form-container">
        <div class="row">
            <div class="col-12 offset-lg-3 col-lg-6 pt-5">
                <h1 class="container-fluid fchd text-uppercase text-center form-complat">Track You Complaint</h1>
                <form class="pb-0"action="./complaint-track-submit.php" method="post">
                    <div class="form-group txt">
                        <label class="label-text">COMPLAINT ID <span class="required text-danger">(Required)</span></label>
                        <input type="text" class="form-control" name="complaint_id" value="<?php if (isset($_GET['complaint_id'])) { echo $_GET['complaint_id']; }?>" required>
                    </div>
                    <button type="submit" name="submit" class="bttn inline-btn">Track</button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('./footer.php'); ?>
</body>
</html>
