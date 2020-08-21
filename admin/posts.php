<?php include_once 'includes/pdo.php'; ?>

<?php
session_start();
if (isset($_SESSION['edit'])) {
unset($_SESSION["edit"]);}

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
					<h1 class="page-header text-center">
						<?= $_SESSION['user_name'] ?>'s Posts
					</h1>
			</div>
			<div class="container-fluid">
				<div class="row mt-2">
					<?php include_once "./includes/flash.php"; ?>
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
                $blog_id = $row['blog_id'];
                echo "<td><a href='edit.php?edit_id=$blog_id' class='btn btn-primary'>Edit</a></td>";

								?>
								<!-- Modal -->
				<div class="modal fade" id="deleteModal<?=$blog_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="deleteModalLabel">Delete Confirmation</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h4>Are you sure to delete this post?</h4>
								<div>
									<div class="row">
										<div class="col-12 text-center">
											<img src="<?= $row['blog_img'] ?>" alt="Blog Image" style="width:30%">
										</div>
										<div class="col-12 text-center">
											<h3><?= $row['blog_title'] ?></h3>
										</div>
									</div>

								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<a href="edit.php?delete_id=<?= $blog_id ?>" class="btn btn-danger">Confirm</a>
							</div>
						</div>
					</div>
				</div>
			<?php
			echo "<td><button type='button' class='btn btn-danger'data-toggle='modal' data-target='#deleteModal$blog_id'>Delete</button></td>";
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

<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
