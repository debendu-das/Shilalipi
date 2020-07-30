<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=blogsystem',
    'deb', 'das');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $stmt = $pdo->query("SELECT email, textarea FROM users");

session_start();

$_SESSION['user_id'] = 1;

?>
<?php include 'includes/header.php'; ?>

<body>

<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">

					<h1 class="page-header">
						Welcome to the Administration Panel
					</h1>
			</div>
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
