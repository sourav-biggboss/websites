<?php
include "../config.php";
$page =  basename($_SERVER['REQUEST_URI']);
$sql = 'SELECT * FROM blogs WHERE page_name ="' . $page . '"';
mysqli_query($conn,'UPDATE `blogs` SET `views`= `views` + 1 WHERE page_name ="' . $page . '"');
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 0) {
    die();
} else {
       $row = $result->fetch_assoc(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?php echo $row['page_title']; ?></title>

  <meta name="description" content="<?php echo $row['page_meta_description']; ?>">

  <link rel="icon" href="" type="image/gif" sizes="16x16" alt="<?php echo $row['page_title']; ?>">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/style.css">
</head>
<?php include 'header.php'; ?>
<br>

<br>

<div class="container">

  <br>
  <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['page_title']; ?>" class="mx-auto d-block img-fluid">
  <br>
  <br>
  <h1 class="text-center font-weight-bold" style="font-size:24px"><?php echo $row['page_title']; ?></h1>

  <span class=""><?php echo $row['long_desc']; ?></span>
  <br>
  <br>

</div>


<?php
include_once('footer.php');
   }
?>