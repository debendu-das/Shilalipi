<?php session_start(); ?>
<?php include 'includes/header.php';?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include 'includes/navigation.php'; ?>
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">

          <h1 class="page-header">
            Welcome to Category
          </h1>
			     <div class="col-sm-6">
						<form action="includes/functions.php" method="post">
							<div class="form-group">
								<input type="text" name="cat_title" placeholder="Category Title" class="form-control">
							</div>
							<div class="form-group">
								<input type="submit" name="cat_add" value="Search" class="btn btn-primary">
							</div>
						</form>

						</div>
               	<div class="col-sm-6">

						</div>
                <!-- /.row -->
            </div>
        </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
