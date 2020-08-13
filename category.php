<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

if (isset($_GET['cat_name'])) {
  $catname = $_GET['cat_name'];
  $fetched = false ;
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $limit = ($page*6) - 6;
  }else {
    $limit = 0;
    $page = 1;
  }

$sql1 = "SELECT cat_id FROM categorie WHERE cat_name = '$catname' ";
$stmt = $pdo->query($sql1);

if(!$row = $stmt->fetch(PDO::FETCH_ASSOC)){
  $_SESSION['error'] = "Invalid Category";
  header('Location: category.php');
  return;
}

}
?>
<?php
include_once "./includes/head.php";
?>

  <body>


    <div class="wrap">

    <?php include_once "./includes/header.php"; ?>

    <section class="site-section pt-5">
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
        <div class="row mb-4">
          <div class="col-md-6">
            <h2 class="mb-4">Category: <?php if(isset($_GET['cat_name'])) echo ($_GET['cat_name']); ?></h2>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-12 col-lg-8">
            <?php include_once 'includes/categorielinks.php' ?>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row mb-5 mt-5">

              <div class="col-md-12">
                <?php include_once 'includes/categoriepost.php'; ?>
              </div>
            </div>

<?php if(isset($_GET['cat_name'])){ ?>

            <div class="row mt-5">
              <div class="col-md-12 text-center">
                <nav aria-label="Page navigation" class="text-center">
                  <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="category.php?cat_name=<?php echo ($catname.'&page='); if($page>1) echo ($page-1); else echo ($page); ?>">&lt;</a></li>

                    <li class="page-item <?php if($page==1) echo ('active'); ?>"><a class="page-link" href="category.php?cat_name=<?php echo ($catname); ?>">1</a></li>
                    <li class="page-item <?php if($page==2) echo ('active'); ?>"><a class="page-link" href="category.php?cat_name=<?php echo ($catname); echo '&page=2'; ?>">2</a></li>
                    <li class="page-item <?php if($page==3) echo ('active'); ?>"><a class="page-link" href="category.php?cat_name=<?php echo ($catname); echo '&page=3'; ?>">3</a></li>
                    <li class="page-item <?php if($page==4) echo ('active'); ?>"><a class="page-link" href="category.php?cat_name=<?php echo ($catname); echo '&page=4'; ?>">4</a></li>
                    <li class="page-item <?php if($page==5) echo ('active'); ?>"><a class="page-link" href="category.php?cat_name=<?php echo ($catname); echo '&page=5'; ?>">5</a></li>
                    <li class="page-item"><a class="page-link" href="category.php?cat_name=<?php echo ($catname.'&page='); if($page<5) echo ($page+1); else echo ($page); ?>">&gt;</a></li>
                  </ul>
                </nav>
              </div>
            </div>
<?php } ?>


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

<?php include_once 'includes/footer.php' ?>
      <!-- END footer -->

    </div>

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    <script src="js/main.js"></script>
  </body>
</html>
