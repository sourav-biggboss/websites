<div class="container-fluid py-1 px-3">
  <!-- over view -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"><?php echo $_SERVER['SERVER_NAME']; ?></a></li>
      <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Blog</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Over Blog</h6>
  </nav>
  <div class="form mt-4 p-4">
    <h1>Over Blog</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Views</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
     $sql_select_blogs = "SELECT * FROM `blogs`";
     $result_blog = $conn->query($sql_select_blogs);
     if ($result_blog->num_rows > 0) {
         // while loop from blogs table
         while ($row = $result_blog->fetch_assoc()) {
             echo " <tr>";
             echo "<td>".$row['page_title']."</td>";
             echo "<td>".$row['views']."</td>";
             echo "<td><a class='btn btn-secondary' href='/blog/".$row['page_name']."'>View</a><a class='btn btn-primary ml-2' href='./?page=editBlog&type=urltoedit&url=".$row['page_name']."'>Edit</a><a class='btn btn-danger ml-2' href='./?page=editBlog&type=drop&url=".$row['page_name']."'>Delete</a></td>";
             echo "</tr>";
         }
     } else {
         echo "0 results";
     }
    ?>
      </tbody>
    </table>
  </div>
