<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=example',
    'deb', 'das');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
    
    if ( isset($_POST['title']) && isset($_POST['categorie']) && isset($_POST['blogimage']) 
        && isset($_POST['categorie']) && isset($_POST['categorie'])

){
}else{

}

// 
    
//     $folder ='uploads/';
//     $blogimage='';
//     $blogimage = $_FILES['blogimage']['name'];

    
//     $path = $folder . $blogimage ; 
//    $target_file=$folder.basename($_FILES["blogimage"]["name"]);
//    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    
//    $allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['blogimage']['name'];
//    $ext=pathinfo($filename, PATHINFO_EXTENSION);
    
//     if(!in_array($ext,$allowed) )
//     {
//         echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";

//     }else{
        
//         move_uploaded_file( $_FILES['blogimage'] ['tmp_name'], $path); 
//         $stmt=$pdo->prepare("INSERT INTO users (email, textarea, images) VALUES ( :title, :textarea, :blogimage)"); 

//         $stmt->bindParam(':title', $_POST['title']); 
//         $stmt->bindParam(':textarea', $_POST['textarea']); 
//         $stmt->bindParam(':blogimage', $blogimage); 
//         $stmt->execute();  
        
//     } 
// }

if(isset($_POST['blogtag'])){
    $tags=$_POST['blogtag'];
    $tag_list = explode (",", $tags);
    $list_tag=array();
    $tag_db=$pdo->query("SELECT name FROM tags");
    while ( $row = $tag_db->fetch(PDO::FETCH_ASSOC) ) {
        $list_tag=array_push($a,$row['name']);
    }
    
    $sql = "INSERT INTO tags (name) 
    VALUES (:name)";
    
    foreach($tag_list as $k => $v ) {
        if (!in_array("$v", $list_tag))
    {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $v ));
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

					<h1 class="page-header">
						Add a New Blog
					</h1>
            </div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->
        <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-3">
            <form action="./addnew.php" enctype="multipart/form-data" method="POST">

                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" class="form-control" id="textinput" name="blog_title" placeholder="Blog Title">
                </div>

                <div class="form-group">
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control" id="catinput" name="blog_cat" placeholder="Blog Categorie">
                </div>

                <div class="form-group">
                    <label for="blogimg">Blog Image</label>
                    <input type="file" name="blog_image">
                </div>

                <div class="form-group">
                    <label for="blogcontent">Blog Content</label>
                    <!-- <div id="summernote"></div> -->
                    <textarea name="blog_content" id="summernote">Write Your Blog Here !</textarea>
                </div>

                <div class="form-group">
                    <label for="tags">Blog Tags</label><span class="text-muted">   Add comma(,) separete values</span>
                    <input type="text" class="form-control" id="blogtag" name="blog_tag">
                </div>

                <button type="submit" class="btn btn-primary" name="ok">Submit</button>
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
        height: 200,
        weight:200
      });
</script>


</body>

</html>
