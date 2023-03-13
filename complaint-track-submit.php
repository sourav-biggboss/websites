<?php
    require("./config.php");

    if(isset($_POST["submit"])) {
        $complaint_id = $_POST['complaint_id'];

        $sql_select_complaint = 'SELECT * FROM complaint_forms WHERE complaint_id = "'.$complaint_id.'"';
        $result_select_complaint = $conn->query($sql_select_complaint);

        if ($result_select_complaint->num_rows == 1) {
            $row_select_complaint = $result_select_complaint->fetch_assoc();
            $row_id = $row_select_complaint['id'];
        }
    } else {
        header ('location: ./complaint-track-form.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Track Complaint</title>
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
        .fchd {
            background: #343a40 !important;
            color:white;
        }
        .timeline {
            background: #f8f8f8;
            padding: 15px;
        }

        .time-label:first-child {
            margin-top: 0;
        }

        .time-label {
            margin-top: 15px;
        }

        .time-label span {
            background: #385067;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: 700;
        }

        .time-body {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            padding: 10px;
            background: #ffffff;
            margin-top: 10px;
            border: 1px solid #69932b;
        }

        .time-body > i {
            background: #e54f07;
            color: #ffffff;
            padding: 5px;
            font-size: 12px;
        }

        .timeline-item {
            width: 100%;
            box-sizing: border-box;
            margin-left: 10px;
        }

        .time {
            display: block;
            text-align: left;
            font-size: 14px;
        }

        .timeline-body {
            font-size: 14px;
            word-break: break-word;
        }

        .card {
            font-size: 14px;
            margin: 0;
            margin-top: 15px;
            font-weight: 700;
            background: #ffffff;
        }

        .messge-box {
            padding: 15px;
            background: #ef7c00;
        }

        .messge-box button {
            margin-top: 15px;
            border-radius: 0;
            border: 0;
            background: #0a222e;
            font-size: 16px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <?php include_once('./header.php'); ?>

    <div class="container-fluid fcs-form-container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="container-fluid fchd text-center text-uppercase" style="font-size:15px">Complaint Timeline</div>
                <?php
                if ($result_select_complaint->num_rows == 1) {
                    if ($row_select_complaint['status'] == '') {
                        $sql_select_timeline = "SELECT * FROM complaint_timeline WHERE meta_id = '".$complaint_id."' ORDER BY id ASC";
                        $result_select_timeline = $conn->query($sql_select_timeline);
                        
                        $timeline = '<div class="timeline">';
                        if ($result_select_timeline->num_rows > 0) {
                            while($row_select_timeline = $result_select_timeline->fetch_assoc()) {
                                $timeline .= '<div class="time-label">';
                                    $timeline .= '<span>';
                                        $timeline .= ''.$row_select_timeline['form_created_on'].' - '.$row_select_timeline['form_created_time'].'';
                                    $timeline .= '</span>';
                                $timeline .= '</div>';

                                if ($row_select_timeline['meta_name'] == 'complaint form') {
                                    $timeline .= '<div class="time-body">';
                                        if ($row_select_timeline['meta_type'] == 'out') {
                                            $timeline .= '<i class="fas fa-arrow-up"></i>';
                                        } else {
                                            $timeline .= '<i class="fas fa-arrow-down"></i>';
                                        }
                                        $timeline .= '<div class="timeline-item">';
                                            $timeline .= '<span class="time"><i class="fas fa-clock"></i> '.$row_select_timeline['form_created_time'].'</span>';
                                            $timeline .= '<div class="timeline-body">';
                                                $timeline .= ''.$row_select_timeline['meta_user'].': '.urldecode($row_select_timeline['meta_description']).'';
                                            $timeline .= '</div>';
                                        $timeline .= '</div>';
                                    $timeline .= '</div>';
                                }
                            }
                            
                            $message_box = 
                            '
                            <div class="messge-box">
                            <textarea class="form-control" id="message" placeholder="Enter your message here..." rows="3"></textarea>    
                            <button type="button" class="btn btn-primary" id="send-button" onclick="sendComplaintMessage()">Send</button>
                            </div>
                            ';
                        }
                        else {
                            $timeline .= 
                            '
                            <div class="card">
                                <div class="card-body">
                                    No Timeline Found.
                                </div>
                            </div>
                            ';
                        };    
                        $timeline .= '</div>';
                        print $timeline;
                        print $message_box;
                    } else {
                        echo '
                        <div class="card">
                            <div class="card-body">
                                Your Complaint Id Is Closed.
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '
                    <div class="card">
                        <div class="card-body">
                            We are currently experiencing some technical issues with old 
                            complaint id. Please file a new grievance here.
                            <br>
                            <a href="./complaint-form.php">File Your Grievance</a>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include_once('./footer.php'); ?>

    <script>
    function sendComplaintMessage() {
        var sendButton = document.querySelector('#send-button');
        var message = document.querySelector('#message');

        sendButton.setAttribute('disabled', 'disabled');
        sendButton.innerHTML = 'Sending';

        var http = new XMLHttpRequest();
        var url = './complaint-submit-re.php';
        var params = 'complaint_id=<?php echo $complaint_id; ?>&message='+message.value;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {          
            console.log(http.responseText);
            setTimeout(function() {
                sendButton.innerHTML = 'Sent';

                setTimeout(function() { 
                sendButton.innerHTML = 'Send';
                sendButton.removeAttribute('disabled');
                window.location.reload();
                }, 1000);
            }, 1000);
            }
        }
        http.send(params);
    }
    </script>
</body>
</html>
