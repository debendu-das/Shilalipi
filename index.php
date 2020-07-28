
<?php
include_once "./includes/head.php";  
?>
  <body>
    <div class="wrap">

    <?php include_once "./includes/header.php"; ?>

      <section class="site-section py-sm">
        <div class="container">
          <div class="row pt-5">
            <div class="col-md-6">
              <h2 class="mb-4">Latest Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
          
          <?php include_once "./includes/posts.php"; ?>


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
              
              <!-- END sidebar-box -->  
              <div class="sidebar-box">
                <h3 class="heading">Popular Posts</h3>
                <?php include_once "./includes/popularpost.php"; ?>

              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <h3 class="heading">Categories</h3>
                <?php include_once "./includes/categoriespost.php"; ?>

              </div>
              <!-- END sidebar-box -->

              <div class="sidebar-box">
                <h3 class="heading">Tags</h3>
                <?php include_once "./includes/tagpost.php"; ?>
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