<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

if(!isset($_GET['user_id'])){
  $_SESSION['error'] = "Invalid User";
  header('location:' . $_SESSION['redirectURL']);
  return;
}
$user_id = $_GET['user_id'] + 0;
$sql1 = "SELECT name, user_img, user_description FROM users WHERE user_id = $user_id ";
$stmt = $pdo->query($sql1);
$row = $stmt->fetch(PDO::FETCH_ASSOC)

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
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">

            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-4">Hi There! I'm <?= $row['name'] ?> </h2>
                <p class="mb-5"><img src="<?= $row['user_img'] ?>" alt="Image placeholder" class="img-fluid" style="width:70vh"></p>
                <p><?= $row['user_description'] ?></p>
              </div>
            </div>

            <div class="row mb-5 mt-5">
              <div class="col-md-12 mb-5">
                <h2>Posts :</h2>
              </div>
              <div class="col-md-12">

                <?php
                $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_view, blog.blog_date, categorie.cat_name, users.name, users.user_img FROM blog JOIN categorie JOIN users ON blog.cat_id = categorie.cat_id AND blog.user_id = $user_id AND users.user_id = blog.user_id ORDER BY blog_id DESC";
                $stmt = $pdo->query($sql1);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $blogid = $row['blog_id'];
                  $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
                  $stmt2 = $pdo->query($sql3);
                  $count = $stmt2->rowCount();
                ?>
                  <div class="post-entry-horzontal">
                    <a href="blog-single.php?blog_id=<?= $blogid ?>">
                      <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url('admin/<?= $row['blog_img'] ?>');"></div>
                      <span class="text">
                        <div class="post-meta">
                          <span class="author mr-2"><img src="<?= $row['user_img'] ?>" alt="user_img"> <?= $row['name'] ?></span>&bullet;
                          <span class="mr-2"><?= $row['blog_date'] ?> </span> &bullet;
                          <span class="mr-2"><?= $row['cat_name'] ?></span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> <?= $count ?></span>
                        </div>
                        <h2><?= $row['blog_title'] ?></h2>
                      </span>
                    </a>
                  </div>

                <?php }
                ?>

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
