<?php 
include('./config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complaint Submitted</title>
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
            height: auto;
        }
        a.track-button {
            background: #69932b;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            padding: 5px 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-3 border border-success text-uppercase">
                <h2 class="text-center"style="font-size:16px;margin:0 !important">Thank You, Your Complaint Has Been Submitted.
                    Your Complaint Id: <span style="color:#e54f07"><strong><?php echo $_GET['complaint_id'];?></strong></span>. Our Executive Will Reply To Your Complaint Within 24 Working Hours. Please Save This Complaint Id To Track Your Replies.

                    <br><br>

                    <?php 
                    if (isset($_GET['complaint_id']) && $_GET['complaint_id'] != '') {
                        ?><a class="track-button" href="./complaint-track-form.php?complaint_id=<?php echo $_GET['complaint_id'];?>">Track Your Complaint</a><?php
                    } else {
                        ?><a class="track-button" href="./complaint-track-form.php">Track Your Complaint</a><?php
                    }
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
