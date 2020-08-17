<?php include_once 'includes/pdo.php'; ?>

<?php
session_start();
if (isset($_SESSION['edit'])) {
unset($_SESSION["edit"]);}

$_SESSION['user_id']=1;
$_SESSION['user_name']='Debendu';
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// if (isset($_GET['edit'])) {
//   $_SESSION['edit_id'] = $_GET['edit'];
// }
?>
<?php include 'includes/header.php'; ?>

<body>

<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper" >

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
					<h1 class="page-header">
						Welcome to the Administration Panel
					</h1>
			</div>
			<div class="container-fluid">
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
          <div class="table-responsive" style="overflow-x:auto;">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <th>Blog No.</th>
                <th>Blog Title</th>
                <th>Blog Image</th>
                <th>Blog Category</th>
                <th>Blog Views</th>
                <th>Blog Date</th>
                <th>Edit</th>
                <th>Delete</th>
              </thead>
              <tbody>
              <?php

              $num=1;
              $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_view, blog.blog_date, categorie.cat_name FROM blog JOIN categorie ON blog.cat_id = categorie.cat_id ORDER BY blog_id DESC";
              $stmt = $pdo->query($sql1);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo($num);
                echo("</td><td>");
                echo($row['blog_title']);
                echo("</td><td>");
                echo("<img src='");
                echo($row['blog_img']);
                echo(" ' style='width:80px;' >");
                echo("</td><td>");
                echo($row['cat_name']);
                echo("</td><td>");
                echo($row['blog_view']);
                echo("</td><td>");
                echo($row['blog_date']);
                echo("</td>");
                $blog_id = $row['blog_id'];
                echo "<td><a href='edit.php?edit_id=$blog_id' class='btn btn-primary'>Edit</a></td>";
                echo "<td><a href='edit.php?delete=$blog_id' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
                $num++;
              }
                 ?>
              </tbody>
              </table>

        </div>

			</div>

		</div>

	</div>

</div>

<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
