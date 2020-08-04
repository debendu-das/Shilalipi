<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

?>

<?php
include_once "./includes/head.php";
if(isset($_SESSION['user_id'])) {
  unset($_SESSION['user_id']);
}
?>
  <body>
    <div class="wrap">

    <?php include_once "./includes/header.php"; ?>

      <section class="site-section py-sm">
        <div class="container">
          <div class="row pt-5">
            <div class="col-md-6">
              <h2 class="mb-4">Popular Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">

                <?php include_once "./includes/popularposts.php"; ?>

              </div>

            </div>
            <!-- END main-content -->
          </div>
            <div class="col-md-12 col-lg-4 sidebar">
              <div class="sidebar-box search-form-wrap">
                <form action="#" class="search-form">
                  <div class="form-group">
                    <span class="icon fa fa-search"></span>
                    <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                  </div>
                </form>
              </div>
              <!-- END sidebar-box -->

              <!-- END sidebar-box -->
              <div class="sidebar-box">
                <div class="row">
                  <div class="col-6">
                    <h3 class="heading">Recent Posts</h3>
                  </div>
                  <div class="col-6">
                    <a href="popular.php">See all</a>
                  </div>
                </div>
                <div class="post-entry-sidebar">
                  <ul>
                    <?php include_once "./includes/recentpost-side.php"; ?>
                  </ul>
                </div>
              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <div class="row">
                  <div class="col-6">
                    <h3 class="heading">Categories </h3>
                  </div>
                  <div class="col-6">
                    <a href="category.html">See all</a>
                  </div>
                </div>
                <ul class="categories">
                <?php include_once "./includes/categoriespost.php"; ?>
                </ul>
              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <div class="row">
                  <div class="col-6">
                    <h3 class="heading">Tags </h3>
                  </div>
                  <div class="col-6">
                    <a href="#">See all</a>
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
