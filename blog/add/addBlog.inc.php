<?php

if ((isset($_POST['filename'])) && ($_POST['filename'] != '') && ($_POST['type'] == 'add')) {

    //upload image
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/blog/image/";
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
    //canging space to - for file name
    $filename = preg_replace('/[^a-zA-Z0-9\']/', '-', $_POST['filename']);
    $filename = strtolower(str_replace("'", '', $filename));
    // intert to blog
    $sql = "INSERT INTO `blogs`(`website_name`, `page_name`, `page_title`, `page_meta_description`, `page_meta_keywords`,`head_inc`, `title`, `short_desc`, `long_desc`, `author`, `created_date`, `image`)  VALUES
           ('".$website."','".mysqli_real_escape_string($conn, $filename)."','".mysqli_real_escape_string($conn, $_POST['title'])."','".mysqli_real_escape_string($conn, $_POST['meta_description'])."','".mysqli_real_escape_string($conn, $_POST['page_meta_keywords'])."','".mysqli_real_escape_string($conn, $_POST['head_inc'])."','".mysqli_real_escape_string($conn, $_POST['title'])."','".mysqli_real_escape_string($conn, $_POST['short_description'])."','".mysqli_real_escape_string($conn, $_POST['contant'])."','".$auther."','".$date."','/blog/image/".$_FILES["img"]["name"]."');";

    if ((mysqli_query($conn, $sql))) {
        echo '<div class="alert alert-success" role="alert">  <h5> Blog created successfully</h5></div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">  <h5> ' . $sql . '<br>' . mysqli_error($conn).'</h5></div>';
    }
}
?>
<script src="ckeditor/ckeditor.js"></script>
<div class="container-fluid py-1 px-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"><?php echo $_SERVER['SERVER_NAME']; ?></a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Blog</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Add Blog</h6>
  </nav>

  <div class="form mt-4 p-4">
    <!-- adding form -->
    <h1>Add Blog</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="form-lable">URL</label>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3"><?php echo $_SERVER['SERVER_NAME']; ?>/blog/</span>
          <input type="text" class="form-control" id="basic-url" name="filename" aria-describedby="basic-addon3">
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Title</label>
        <input type="text" class="form-control" name="title" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Meta Discription</label>
        <input type="text" class="form-control" name="meta_description" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">keywords</label>
        <input type="text" class="form-control" name="page_meta_keywords" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Head Tag</label>
        <input type="text" class="form-control" name="head_inc" >
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Image</label>
        <input type="file" class="form-control" name="img" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Short Discription</label>
        <input type="text" class="form-control" name="short_description" required>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Contant</label>
        <textarea class="form-control" name="contant" rows="20" type="text" id="containt" required></textarea>
      </div>
      <input type="hidden" value="<?php echo $_POST['pass']; ?>" name="pass" required>
      <input type="hidden" value="add" name="type" required>
      <input type="hidden" value="addBlog" name="page" required>
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
  </div>
</div>
<script>
    // text editor
    CKEDITOR.replace( 'containt' );
</script>
