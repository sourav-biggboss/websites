<?php
if (isset($_GET['type']) && ($_GET['type'] == 'drop') && (isset($_GET['url']))) {
  $sql_delete = "DELETE FROM `blogs` WHERE `page_name` = '".mysqli_real_escape_string($conn, $_GET['url'])."'";
  if ((mysqli_query($conn, $sql_delete))) {
      echo '<div class="alert alert-success" role="alert">  <h5> Blog Deleteted successfully</h5></div>';
  } else {
      echo '<div class="alert alert-danger" role="alert">  <h5> failed ' . $sql . '<br>' . mysqli_error($conn).'</h5></div>';
  }
}
if (isset($_POST['type']) && ($_POST['type'] == 'edit_submit')) {
    if ((isset($_FILES["img"]["name"])) && ($_FILES["img"]["name"] != '')) {
        //upload image
        $target_dir = $_SERVER['DOCUMENT_ROOT']."/blog/image/";
        $sql_img_path = "/blog/image/".$_FILES["img"]["name"];
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if ($_FILES["img"]["size"] > 5*1048576) {
            $uploadOk = 0;
        }
        if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                die('<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>');
            }
        }
    } else {
        $sql_img_path = mysqli_real_escape_string($conn, $_POST['img_default_path']);
    }

    //canging space to - for filename
    $filename = preg_replace('/[^a-zA-Z0-9\']/', '-', $_POST['filename']);
    $filename = strtolower(str_replace("'", '', $filename));
    //upadaing colume
    $sql = "UPDATE `blogs` SET
    `website_name`= '".$website."',
    `page_name`= '".mysqli_real_escape_string($conn, $filename)."',
    `page_title`= '".mysqli_real_escape_string($conn, $_POST['title'])."',
    `page_meta_description`= '".mysqli_real_escape_string($conn, $_POST['meta_description'])."',
    `page_meta_keywords`= '".mysqli_real_escape_string($conn, $_POST['page_meta_keywords'])."',
    `head_inc`= '".mysqli_real_escape_string($conn, $_POST['head_inc'])."',
    `title`= '".mysqli_real_escape_string($conn, $_POST['title'])."',
    `short_desc`= '".mysqli_real_escape_string($conn, $_POST['short_description'])."',
    `long_desc`= '".mysqli_real_escape_string($conn, $_POST['contant'])."',
    `author`= '".$auther."',
    `created_date`= '".$date."',
    `image`= '".$sql_img_path."'
     WHERE `id` = '".mysqli_real_escape_string($conn, $_POST['blog_id'])."'";

    if ((mysqli_query($conn, $sql))) {
        echo '<div class="alert alert-success" role="alert">  <h5> Blog Updated successfully</h5></div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">  <h5> ' . $sql . '<br>' . mysqli_error($conn).'</h5></div>';
    }
}
?>
<div class="container-fluid py-1 px-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"><?php echo $_SERVER['SERVER_NAME']; ?></a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Blog</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Edit Blog</h6>
  </nav>

  <?php
  if ((isset($_GET['url'])) && ($_GET['url'] != '') && ($_GET['type'] == 'urltoedit')) {
      // fetching colume from url

      $sql = "SELECT * FROM `blogs` WHERE `page_name` = '".mysqli_real_escape_string($conn, $_GET['url'])."'; ";
      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc(); ?>
  <script src="ckeditor/ckeditor.js"></script>
  <div class="form mt-4 p-4">
    <!-- edite from -->
    <h1>Edit Blog</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="form-lable">URL</label>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3"><?php echo $_SERVER['SERVER_NAME']; ?>/blog/</span>
          <input type="text" class="form-control" id="basic-url" name="filename" value="<?php echo $row['page_name'] ?>" aria-describedby="basic-addon3" required>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $row['page_title'] ?>" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Meta Discription</label>
        <input type="text" class="form-control" name="meta_description" value="<?php echo $row['page_meta_description'] ?>" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">keywords</label>
        <input type="text" class="form-control" name="page_meta_keywords" value="<?php echo $row['page_meta_keywords'] ?>" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Head Tag</label>
        <input type="text" class="form-control" name="head_inc" value="<?php echo $row['head_inc'] ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Image</label>
        <input type="file" class="form-control" name="img">
        <input type="hidden" name="img_default_path" value="<?php echo $row['image'] ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Short Discription</label>
        <input type="text" class="form-control" name="short_description" value="<?php echo $row['short_desc'] ?>" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Contant</label>
        <textarea class="form-control" name="contant" rows="20" type="text" id="containt" required><?php echo $row['long_desc'] ?></textarea>
      </div>
      <input type="hidden" value="<?php echo $_POST['pass']; ?>" name="pass" required>
      <input type="hidden" value="edit_submit" name="type" required>
      <input type="hidden" value="editBlog" name="page" required>
      <input type="hidden" name="blog_id" value="<?php echo $row['id'] ?>" required>
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
  </div>
  <?php
      } else {
          echo '<div class="alert alert-danger" role="alert">  <h5> Blog not Found </h5></div>';
      }
  } else { //default form for taking uurl to id
    ?>

  <div class="form mt-4 p-4">
    <h1>Edit Blog</h1>
    <form action="" method="get" enctype="multipart/form-data">
      <div class="form-group">
        <label for="form-lable">URL</label>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3"><?php echo $_SERVER['SERVER_NAME']; ?>/blog/</span>
          <input type="text" class="form-control" id="basic-url" name="url" aria-describedby="basic-addon3">
        </div>
      </div>

      <input type="hidden" value="urltoedit" name="type" required>
      <input type="hidden" value="editBlog" name="page" required>
      <button type="submit" class="btn btn-primary mb-2">Next</button>
    </form>
  </div>
</div>

<?php
    }
   ?>
   <script>
       // text editor
       CKEDITOR.replace( 'containt' );
   </script>
