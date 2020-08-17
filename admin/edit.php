<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=blogsystem',
    'deb', 'das');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
session_start();  //session start
$_SESSION['user_id']=1; // !NEED TO MODIFY
//form validation start
$edit_id=0;

if(isset($_GET['delete_id'])){
  $edit_id = $_GET['delete_id']+0;

  $sql2 = "SELECT blog.blog_id, blog.cat_id FROM blog JOIN categorie ON blog.cat_id = categorie.cat_id AND blog.blog_id = $edit_id ";
  $stmt = $pdo->query($sql2);
  if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
    $sqlupdate = "UPDATE categorie SET used = used - 1 WHERE cat_id = :cat ";
    $stmtupdate = $pdo->prepare($sqlupdate);
    $stmtupdate->execute(array(
      ':cat' => $data['cat_id'] ));
  }else {
    $_SESSION['error'] = 'Invalid Post';
    header( 'Location: posts.php' ) ;
    return;
  }

  $sql2 = " SELECT tag.tag_id FROM tag JOIN blogtags JOIN blog ON blogtags.blog_id = blog.blog_id AND blogtags.tag_id = tag.tag_id AND blog.blog_id = $edit_id ";
  $tagdata = $pdo->query($sql2);
  while($row = $tagdata->fetch(PDO::FETCH_ASSOC)){
    $sqlupdate = "UPDATE tag SET used = used - 1 WHERE tag_id = :tag ";
    $stmtupdate = $pdo->prepare($sqlupdate);
    $stmtupdate->execute(array(
      ':tag' => $row['tag_id']));
  }

  $sql="DELETE FROM blogtags WHERE blog_id = :blog_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':blog_id' => $edit_id));

  $sql="DELETE FROM comments WHERE blog_id = :blog_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':blog_id' => $edit_id));

  $sql="DELETE FROM blog WHERE blog_id = :blog_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':blog_id' => $edit_id));

  $_SESSION['success'] = 'Post Deleted';
  header( 'Location: posts.php' ) ;
  return;
}
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
}
if (!isset($_SESSION['edit'])) {
  $sql2 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_content, blog.cat_id, categorie.cat_name FROM blog JOIN categorie ON blog.cat_id = categorie.cat_id AND blog.blog_id = $edit_id ";
  $stmt = $pdo->query($sql2);
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['blog_title'] = $data['blog_title'];
  $_SESSION['blog_cat'] = $data['cat_name'];
  $_SESSION['blog_content'] = $data['blog_content'];
  $_SESSION['blog_img'] = $data['blog_img'];
  $_SESSION['cat_id'] = $data['cat_id'];

  $_SESSION['blogimge'] = $_SESSION['blog_img'];
  $_SESSION['blogtitle'] = $_SESSION['blog_title'];
  $_SESSION['blogcat'] = $_SESSION['blog_cat'];
  $_SESSION['blogcontent'] = $_SESSION['blog_content'];
  $bool = true;
  $sql2 = " SELECT tag.tag_name FROM tag JOIN blogtags JOIN blog ON blogtags.blog_id = blog.blog_id AND blogtags.tag_id = tag.tag_id AND blog.blog_id = $edit_id ";
  $tagdata = $pdo->query($sql2);
  while ($row = $tagdata->fetch(PDO::FETCH_ASSOC)) {
    if ($bool) {
      $_SESSION['blog_tag'] = $row['tag_name'];
      $bool = false;
      continue;
    }
    $_SESSION['blog_tag'] = $_SESSION['blog_tag'].','.$row['tag_name'];
  }
  $_SESSION['blogtag'] = $_SESSION['blog_tag'];

  $_SESSION['edit'] = $_GET['edit_id'];
}

if (isset($_POST['edit'])) { //submit for or not

  $_SESSION['blogtitle'] = $_POST['blog_title'];
  $_SESSION['blogcat'] = $_POST['blog_cat'];
  $_SESSION['blogcontent'] = $_POST['blog_content'];
  $_SESSION['blogtag'] = $_POST['blog_tag'];
        $blog=$_SESSION['edit']+0;

  if ( empty($_POST['blog_title']) || empty($_POST['blog_cat']) || empty($_POST['blog_content']) || empty($_POST['blog_tag']) ){
    $_SESSION["error"] = "All Fields Required";
    header( 'Location: edit.php?edit_id='.$edit_id.'' );
    return;
  }

//Categorie Table data INSERT
  if($_SESSION['blog_cat']!=$_SESSION['blogcat']){
    $sqlupdate = "UPDATE categorie SET used = used - 1 WHERE cat_name = :cat ";
    $stmtupdate = $pdo->prepare($sqlupdate);
    $stmtupdate->execute(array(
      ':cat' => $_SESSION['blog_cat'] ));

    $sql = "INSERT INTO categorie ( cat_name ) SELECT * FROM (SELECT :v) AS tmp
            WHERE NOT EXISTS ( SELECT cat_name FROM categorie WHERE cat_name = :v ) LIMIT 1;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':v' => $_SESSION['blogcat']));
    //cat_id
    $cat = $_SESSION['blogcat'] ;
    $sql2 = "SELECT * FROM categorie WHERE cat_name = '$cat' " ;
    $stmt = $pdo->query($sql2);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $cat_id = $row['cat_id'];
    //cat used update
    $sqlupdate = "UPDATE categorie SET used = used + 1 WHERE cat_id = :cat ";
    $stmtupdate = $pdo->prepare($sqlupdate);
    $stmtupdate->execute(array(
      ':cat' => $cat_id));
  }else {
    $cat_id = $_SESSION['cat_id']+0;
  }

//Tag Table data INSERT
        //tag making
    if(strcmp($_SESSION['blog_tag'],$_SESSION['blogtag'])!=0){
      $tags=$_SESSION['blog_tag'];
      $tag_list = explode (",", $tags);

      foreach($tag_list as $k => $v ) {
        $sql2 = "SELECT * FROM tag WHERE tag_name = '$v' " ;
        $stmt = $pdo->query($sql2);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $tag_id = $row['tag_id'];

        $sqlupdate = "UPDATE tag SET used = used - 1 WHERE tag_id = :tag ";
        $stmtupdate = $pdo->prepare($sqlupdate);
        $stmtupdate->execute(array(
          ':tag' => $tag_id));
      }

      $sql2 = "DELETE FROM blogtags WHERE blog_id = :blog_id";
      $stmt = $pdo->prepare($sql2);
      $stmt->execute(array(':blog_id' => $edit_id ));

      $tags = $_SESSION['blogtag'];
      $tag_list = explode (",", $tags);
      //inserting data
      foreach($tag_list as $k => $v ) {
        $sql = "INSERT INTO tag ( tag_name ) SELECT * FROM (SELECT :v) AS tmp
                WHERE NOT EXISTS ( SELECT tag_name FROM tag WHERE tag_name = :v) LIMIT 1;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':v' => $v));
      }

      foreach($tag_list as $k => $v ) {
        $sql2 = "SELECT * FROM tag WHERE tag_name = '$v' " ;
        $stmt = $pdo->query($sql2);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $tag_id = $row['tag_id'];

        $sqlupdate = "UPDATE tag SET used = used + 1 WHERE tag_id = :tag ";
        $stmtupdate = $pdo->prepare($sqlupdate);
        $stmtupdate->execute(array(
          ':tag' => $tag_id));

        $sql = "INSERT INTO blogtags (blog_id, tag_id) VALUES ( :blog_id, :tag_id )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':blog_id' => $blog,
            ':tag_id' => $tag_id ));
      }


    }

        $blog_image = $_FILES['blog_img']['name'];
        if (isset($_FILES['blog_img']) && $blog_image != "") {
          $folder ='uploads/';
          $blog_image = $_FILES['blog_img']['name'];
          $newname = $folder . time() ."-". rand(1000, 9999). $blog_image ;
          $target_file=$folder.basename($_FILES["blog_img"]["name"]);
          $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
          move_uploaded_file( $_FILES['blog_img'] ['tmp_name'], $newname);
        }else {
          $newname = $_SESSION['blog_img'];
        }


        $sql = "UPDATE blog SET blog_title = :blog_title, blog_img = :blogimage, blog_content = :blog_content, cat_id = :cat_id WHERE blog_id = $blog";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
              ':blog_title' => $_SESSION['blogtitle'],
              ':blogimage' => $newname,
              ':blog_content' => $_SESSION['blogcontent'],
              ':cat_id' => $cat_id ));

//Unset all Seassional variable for Form Validation
        unset($_SESSION["blogtitle"]);
        unset($_SESSION["blogcat"]);
        unset($_SESSION["blogcontent"]);
        unset($_SESSION["blogtag"]);
        unset($_SESSION["blogimge"]);

        unset($_SESSION["blog_title"]);
        unset($_SESSION["blog_img"]);
        unset($_SESSION["blog_cat"]);
        unset($_SESSION["blog_content"]);
        unset($_SESSION["blog_tag"]);
        unset($_SESSION["blog_img"]);
        unset($_SESSION["cat_id"]);

        unset($_SESSION["edit"]);

//Sucess message
        $_SESSION["success"] = "Blog Updated";
        header( 'Location: posts.php');
        return;

}

?>


<?php include 'includes/header.php'; ?>

<body>
<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container">

			<!-- Page Heading -->
			<div class="row">

					<h1 class="page-header text-center">
						Edit Your Blog
					</h1>
            </div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->
        <div class="container">
            <div class="row">

          <?php
           if (isset($_SESSION['error'])) {
             echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
             unset($_SESSION["error"]);
           }
           if (isset($_SESSION['success'])) {
             echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
             unset($_SESSION["success"]);
           }
           ?>

            </div>
        <div class="row">
            <div class="col-12 col-md-10 offset-3">
            <form action="./edit.php?edit_id=<?= $_SESSION['edit'] ?>" enctype="multipart/form-data" method="POST">

                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" class="form-control" id="textinput" name="blog_title" placeholder="Blog Title" value="<?php echo (isset($_SESSION['blogtitle']) ? $_SESSION['blogtitle'] : ''); ?>">
                </div>

                <div class="form-group">
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control" id="catinput" name="blog_cat" placeholder="Blog Categorie" value="<?php echo (isset($_SESSION['blogcat']) ? $_SESSION['blogcat'] : ''); ?>">
                </div>

                <div class="form-group">
                    <label for="blogimg">Blog Image</label>

                    <div class="form-group">
                        <img src="<?= $_SESSION['blogimge'] ?>" alt="Blog Image" class="img-fluid" style="width:20%">
                    </div>

                    <input type="file" class="form-control" id="file" name="blog_img"
              			        onchange="return fileValidation()" />
                </div>

                <div class="form-group">
                    <label for="blogcontent">Blog Content</label>
                    <!-- <div id="summernote"></div> -->
                    <textarea name="blog_content" id="summernote" ><?php echo (isset($_SESSION['blogcontent']) ? $_SESSION['blogcontent'] : ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="tags">Blog Tags</label><span class="text-muted">   Add comma(,) separete values</span>
                    <input type="text" class="form-control" id="blog_tag" name="blog_tag" value="<?php echo (isset($_SESSION['blogtag']) ? $_SESSION['blogtag'] : ''); ?>">
                </div>
                <input type="submit" name="edit" value="Edit Post"  class="btn btn-primary">
            </form>
            </div>
        </div>
    </div>


	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="./summernote/summernote-bs4.js"></script>

<script>
      $('#summernote').summernote({
        placeholder: 'Write your Blog here !',
        tabsize: 2,
        height: 500,
        weight:200
      });
</script>
<script>
        function fileValidation() {
            var fileInput =
                document.getElementById('file');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Only Jpg, Jpeg & Png type file allowed');
                fileInput.value = '';
                return false;
            }
            else
            {

                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'imagePreview').innerHTML =
                            '<img src="' + e.target.result
                            + '"/>';
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

</body>

</html>
