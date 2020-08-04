<?php include 'includes/pdo.php';
session_start();

?>

<?php
include_once "./includes/head.php";
?>
<body>
  <div class="wrap">
    <?php include_once "./includes/header.php"; ?>




        <section class="h-100">
      		<div class="container h-100 pt-5 pb-5">
      			<div class="row justify-content-md-center h-100">
      				<div class="card-wrapper">
      					<div class="card fat">
                  <?php

                    if (isset($_GET['signup'])) {
                      include_once "./includes/signup.php";
                    }elseif (isset($_GET['forget'])) {
                      include_once "./includes/forget.php";
                    }elseif(isset($_GET['forget'])){
                      include_once "./includes/forget.php";
                    }else {
                      include_once "./includes/signin.php";
                    }
                    
                   ?>
      					</div>

      				</div>
      			</div>
      		</div>
    </section>

    <?php include_once "./includes/footer.php"; ?>
  </div>
  <?php include_once "./includes/scripts.php"; ?>
  <script src="js/my-login.js"></script>

</body>
