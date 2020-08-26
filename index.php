<?php include 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';
if(isset($_GET['logout'])){
  $_SESSION['success'] = 'You are Logged Out';
  unset($_SESSION["user_id"]);
  unset($_SESSION["user_name"]);
  header('location: index.php');
  return;
}
?>

<?php
include_once "./includes/head.php";
?>
  <body>
    <div class="wrap">

    <?php $active='home'; include_once "./includes/header.php"; ?>

      <section class="site-section py-sm">
        <div class="container">

          <div class="row mt-2">
            <?php include_once "./includes/flash.php"; ?>
          </div>

          <div class="row pt-5">
            <div class="col-md-6">
              <h2 class="mb-4">Latest Posts</h2>
            </div>
          </div>

          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row mb-5 mt-5">

                <?php include_once "./includes/posts.php"; ?>

              </div>
            </div>
            <!-- END main-content -->
          </div>
            <div class="col-md-12 col-lg-4 sidebar">
              <div class="sidebar-box search-form-wrap">
                <form action="search.php" method="GET" class="search-form">
                  <div class="form-group">
                    <input type="text" name="search" class="form-control" id="s" placeholder="Type a keyword and hit enter" required>
                    <span class="icon fa fa-search"></span>
                  </div>
                </form>
              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <div class="row">
                  <div class="col-8">
                    <h3 class="heading">Popular Posts</h3>
                  </div>
                  <div class="col-4">
                    <a href="popular.php">See all</a>
                  </div>
                </div>
                <div class="post-entry-sidebar">
                  <ul>
                    <?php include_once "./includes/popularpost-side.php"; ?>
                  </ul>
                </div>
              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <div class="row">
                  <div class="col-8">
                    <h3 class="heading">Categories </h3>
                  </div>
                  <div class="col-4">
                    <a href="category.php">See all</a>
                  </div>
                </div>
                <ul class="categories">
                <?php include_once "./includes/categoriespost.php"; ?>
                </ul>
              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <div class="row">
                  <div class="col-8">
                    <h3 class="heading">Tags </h3>
                  </div>
                  <div class="col-4">
                    <a href="tags.php">See all</a>
                  </div>
                </div>
                <ul class="tags">
                <?php include_once "./includes/tagpost.php"; ?>
                </ul>
              </div>

            </div>
            <!-- END sidebar -->

          </div>
        </div>
      </section>

      <?php include_once "./includes/footer.php"; ?>

    </div>

    <?php include_once "./includes/scripts.php"; ?>

  </body>
</html>
