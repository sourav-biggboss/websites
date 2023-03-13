<?php
if (isset($_POST['type']) && ($_POST['type'] == 'upload_file')) {
    if ((isset($_FILES["img"]["name"])) && ($_FILES["img"]["name"] != '')) {
        //upload file
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
        //   if ($_FILES["img"]["size"] > 5*1048576) {
        //       $uploadOk = 0;
        //   }
        //   if ($imageFileType != "webp" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif") {
        //       $uploadOk = 0;
        //   }
        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                //  while uploading error
                die('<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>');
            } else {
                // success
                echo '<div class="alert alert-success" role="alert">Uploaded your file. path of file : ['.$_SERVER['DOCUMENT_ROOT'].$sql_img_path.']</div>';
            }
        }
    } else {
        // if file not found
        die('<div class="alert alert-danger" role="alert">Sorry, Select your file.</div>');
    }
}
?>
<div class="container-fluid py-1 px-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"><?php echo $_SERVER['SERVER_NAME']; ?></a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Upload Blog</li>
    </ol>
    <!-- upload form -->
    <h6 class="font-weight-bolder mb-0">Upload File</h6>
  </nav>
  <div class="form mt-4 p-4">
    <h1>Upload File</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">File</label>
        <input type="file" class="form-control" name="img">
        <input type="hidden" name="img_default_path">
      </div>

      <input type="hidden" value="upload_file" name="type" required>
      <input type="hidden" value="uploadFile" name="page" required>
      <button type="submit" class="btn btn-primary mb-2">Upload</button>
    </form>
  </div>
</div>
