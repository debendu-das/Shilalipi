<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

?>

<?php
include_once "./includes/head.php";
?>
  <body>


    <div class="wrap">

      <?php $active='about'; include_once "./includes/header.php"; ?>

    <section class="site-section pt-5">
      <div class="container">
        <div class="row mt-2">
          <?php include_once "./includes/flash.php"; ?>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">

            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-4">Hi There! I'm Debendu Das</h2>
                <p class="mb-5"><img src="admin/uploads/debendu.png" alt="Image placeholder" class="img-fluid"></p>
                <p>I am from "The City Of Joy", Kolkata.</p>
                <p>I am a student of Electrical Enginereing of Techno International Newtown. Currently I am in 3rd year and I apart from my domain Electrical Engineering, I also have a huge interest in coding and other technologies. I love to code soo much. </p>
                <p>This website is just a wounderful project of mine which is based on PHP & MySQL. Both the languages are awesome. The complete website source code is available on github so check it now!!</p>
              </div>
            </div>

            <div class="row mb-5 mt-5">
              <div class="col-md-12 mb-5">
                <h2>Posts :</h2>
              </div>
              <div class="col-md-12">

                <?php include_once "./includes/categoriepost.php"; ?>

              </div>
            </div>

            <div class="row">
              <div class="col-12 mx-auto text-center">
                <a class="page-item page-link" href="index.php">See More</a>
              </div>
            </div>
          </div>

          <!-- END main-content -->

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
