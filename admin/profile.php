<?php include_once 'includes/pdo.php'; ?>

<?php
session_start();
if (isset($_SESSION['edit'])) {
unset($_SESSION["edit"]);}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

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
					<h1 class="page-header text-center">
						<?= $_SESSION['user_name'] ?>'s Profile
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
          <div class="col-md-12 offset-md-3">
            <?php
            $sql="SELECT name, user_img, user_description FROM users WHERE user_id = $user_id";
            $stmt = $pdo->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC)

             ?>
            <h2 class="mb-4">Hi There! I'm <?= $row['name'] ?></h2>
            <p class="mb-5"><img src="../<?= $row['user_img'] ?>" alt="Image placeholder" class="img-fluid" style="width:40%"></p>
            <div class="mb-3 h3">
              <?= $row['user_description'] ?>
            </div>
            </div>
        </div>

        <div class="row mb-5 mt-5">
          <div class="col-md-12 mb-5">
            <h2>Posts :</h2>
          </div>
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
							</thead>
							<tbody>
							<?php

							$num=1;
							$sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_view, blog.blog_date, categorie.cat_name FROM blog JOIN categorie ON blog.cat_id = categorie.cat_id AND blog.user_id = $user_id ORDER BY blog_id DESC";
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
								echo "</tr>";
								$num++;
							} ?>
						</tbody>
					</table>

				</div>

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
