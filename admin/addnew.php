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
if (isset($_POST['publish']) || isset($_POST['edit'])) { //submit for or not

  $_SESSION['blogtitle'] = $_POST['blog_title'];
  $_SESSION['blogcat'] = $_POST['blog_cat'];
  $_SESSION['blogcontent'] = $_POST['blog_content'];
  $_SESSION['blogtag'] = $_POST['blog_tag'];
  $blog_image = $_FILES['blog_img']['name'];

  if ( empty($_POST['blog_title']) || empty($_POST['blog_cat']) || empty($_POST['blog_content']) || empty($_POST['blog_tag']) || (!(isset($_FILES['blog_img']) && $blog_image != "")) ){

    $_SESSION["error"] = "All Fields Required";
    header( 'Location: addnew.php');
    return;

  }else{

      $blog_image = $_FILES['blog_img']['name'];
      //if (isset($_FILES['blog_img']) && $blog_image != "") {

      $folder ='uploads/';
      $blog_image = $_FILES['blog_img']['name'];
      $newname = $folder . time() ."-". rand(1000, 9999). $blog_image ;
      $target_file=$folder.basename($_FILES["blog_img"]["name"]);
      $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

//Image Validation
      $allowed=array('jpeg','png' ,'jpg');
      $filename=$_FILES['blog_img']['name'];
      $ext=pathinfo($filename, PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ){
        $_SESSION['error']="Only Jpeg, Jpg Png and Jpg files available";

        $_SESSION['blogtitle'] = $_POST['blog_title'];
        $_SESSION['blogcat'] = $_POST['blog_cat'];
        $_SESSION['blogcontent'] = $_POST['blog_content'];
        $_SESSION['blogtag'] = $_POST['blog_tag'];

        header( 'Location: addnew.php');
        return;
      }else{

//Categorie Table data INSERT
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


//Tag Table data INSERT
        //tag making
        $tags=$_POST['blog_tag'];
        $tag_list = explode (",", $tags);
        //inserting data
        foreach($tag_list as $k => $v ) {
          $sql = "INSERT INTO tag ( tag_name ) SELECT * FROM (SELECT :v) AS tmp
                  WHERE NOT EXISTS ( SELECT tag_name FROM tag WHERE tag_name = :v) LIMIT 1;";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':v' => $v));
        }

        //datetime of publish
        $datetime = date("M d,Y h:ia");
        //image upload
        move_uploaded_file( $_FILES['blog_img'] ['tmp_name'], $newname);

        // $sql = "INSERT INTO users (email, textarea, images) VALUES ( :title, :textarea, :blogimage)";
        $sql = "INSERT INTO blog ( blog_title, blog_img, blog_content, blog_date, cat_id, user_id)
                VALUES ( :blog_title, :blogimage, :blog_content, :blog_date, :cat_id, :user_id ) ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':blog_title' => $_SESSION['blogtitle'],
            ':blogimage' => $newname,
            ':blog_content' => $_SESSION['blogcontent'],
            ':blog_date' => $datetime,
            ':cat_id' => $cat_id,
            ':user_id' => $_SESSION['user_id'] ));
        //blog_id
        $blog_id = $pdo->lastInsertId();

        //  $stmt->execute(array(
        //     ':title' => $_POST['blog_title'],
        //      ':textarea' => $_POST['blog_content'],
        //      ':blogimage' => $newname));
        //  $blog_id = $pdo->lastInsertId();
        //

//Blogtag Many to Many data insert
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
              ':blog_id' => $blog_id,
              ':tag_id' => $tag_id ));
        }

//Unset all Seassional variable for Form Validation
        unset($_SESSION["blogtitle"]);
        unset($_SESSION["blogcat"]);
        unset($_SESSION["blogcontent"]);
        unset($_SESSION["blogtag"]);

//Sucess message
        $_SESSION["success"] = "Blog Added";
        header( 'Location: posts.php');
        return;
      }
  }

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
						Add a New Blog
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
            <form action="./addnew.php" enctype="multipart/form-data" method="POST">

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
                    <input type="file" name="blog_img">
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
                <input type="submit" name="publish" value="Publish Post"  class="btn btn-primary">
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

</body>

</html>
