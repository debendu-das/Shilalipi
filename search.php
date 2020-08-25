<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

?>

<?php
include_once "./includes/head.php";
?>
  <body>


    <div class="wrap">

      <?php include_once "./includes/header.php"; ?>

    <section class="site-section pt-5">
      <div class="container">
        <div class="row mt-2">
          <?php include_once "./includes/flash.php"; ?>
        </div>
        <div class="row mb-4">
          <div class="col-md-6">
            <h2 class="mb-4">Search: <?php if(isset($_GET['search'])) echo ($_GET['search']); ?></h2>
          </div>
        </div>
        <div class="row blog-entries">
          <!-- Blog -->
          <div class="col-md-12 main-content mb-3">
            <h4 class="row ml-5">
              <i class="fa fa-stop-circle"></i>&nbsp; Blogs =>
            </h4>
            <div class="row">
              <div id="owl1" class="owl-carousel owl-theme col-12">

              <?php
              $search = '%'.$_GET['search'].'%';
              $fetched = false;
              $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, categorie.cat_name FROM blog JOIN categorie Where blog.cat_id = categorie.cat_id AND blog.blog_title LIKE '$search' ORDER BY RAND() LIMIT 15";
              $stmt = $pdo->query($sql1);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fetched = true;
                $blogid = $row['blog_id'];
                $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
                $stmt2 = $pdo->query($sql3);
                $count = $stmt2->rowCount();

               ?>

              <div class="item m-3 ">
                <a href="blog-single.php?blog_id=<?= $blogid ?>" class="a-block sm d-flex align-items-center height-md relatedimage" style="background-image: url('admin/<?php echo ($row["blog_img"]); ?>'); ">
                  <div class="text">
                    <div class="post-meta">
                      <span class="category"><?= $row['cat_name'] ?></span>
                      <span class="mr-2"><?= $row['blog_date'] ?></span>&bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> <?= $count ?></span>
                    </div>
                    <h3><?= $row['blog_title'] ?></h3>
                  </div>
                </a>
              </div>
              <?php }
              if(!$fetched){
                echo "<div class='item m-5'>No Blog Found</div>";
              } ?>
              </div>
            </div>
          </div>

          <!-- Cat -->
          <div class="col-md-12 main-content mb-3">
            <h4 class="row ml-5">
              <i class="fa fa-stop-circle"></i>&nbsp; Category =>
            </h4>
            <div class="row">
              <div id="owl2" class="owl-carousel owl-theme col-12">

              <?php
              $search = '%'.$_GET['search'].'%';
              $fetched = false;
              $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, categorie.cat_name FROM blog JOIN categorie Where blog.cat_id = categorie.cat_id AND categorie.cat_name LIKE '$search' ORDER BY RAND() LIMIT 15";
              $stmt = $pdo->query($sql1);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fetched = true;
                $blogid = $row['blog_id'];
                $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
                $stmt2 = $pdo->query($sql3);
                $count = $stmt2->rowCount();

               ?>

              <div class="item m-3 ">
                <a href="blog-single.php?blog_id=<?= $blogid ?>" class="a-block sm d-flex align-items-center height-md relatedimage" style="background-image: url('admin/<?php echo ($row["blog_img"]); ?>'); ">
                  <div class="text">
                    <div class="post-meta">
                      <span class="category"><?= $row['cat_name'] ?></span>
                      <span class="mr-2"><?= $row['blog_date'] ?></span>&bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> <?= $count ?></span>
                    </div>
                    <h3><?= $row['blog_title'] ?></h3>
                  </div>
                </a>
              </div>
              <?php }
              if(!$fetched){
                echo "<div class='item m-5'>No Category Found</div>";
              } ?>
              </div>
            </div>
          </div>


          <!-- Tag -->
          <div class="col-md-12 main-content mb-3">
            <h4 class="row ml-5">
              <i class="fa fa-stop-circle"></i>&nbsp; Tags =>
            </h4>
            <div class="row">
              <div id="owl3" class="owl-carousel owl-theme col-12">

              <?php
              $search = '%'.$_GET['search'].'%';
              $fetched = false;
              $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, categorie.cat_name FROM blog JOIN categorie JOIN blogtags JOIN tag Where blog.cat_id = categorie.cat_id AND blogtags.blog_id = blog.blog_id AND blogtags.tag_id = tag.tag_id AND tag.tag_name LIKE '$search' ORDER BY RAND() LIMIT 15";
              $stmt = $pdo->query($sql1);
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fetched = true;
                $blogid = $row['blog_id'];
                $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
                $stmt2 = $pdo->query($sql3);
                $count = $stmt2->rowCount();

               ?>

              <div class="item m-3 ">
                <a href="blog-single.php?blog_id=<?= $blogid ?>" class="a-block sm d-flex align-items-center height-md relatedimage" style="background-image: url('admin/<?php echo ($row["blog_img"]); ?>'); ">
                  <div class="text">
                    <div class="post-meta">
                      <span class="category"><?= $row['cat_name'] ?></span>
                      <span class="mr-2"><?= $row['blog_date'] ?></span>&bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> <?= $count ?></span>
                    </div>
                    <h3><?= $row['blog_title'] ?></h3>
                  </div>
                </a>
              </div>
              <?php }
              if(!$fetched){
                echo "<div class='item m-5'>No Tags Found</div>";
              } ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <?php include_once "./includes/footer.php"; ?>

  </div>

  <?php include_once "./includes/scripts.php"; ?>
  <script src="js/my-login.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {

    $("#owl1,#owl2,#owl3").owlCarousel({

      autoplay:true,
      loop:true,
      responsiveClass:true,
      responsive:{
        0:{
            items:1,
          },

        1000:{
            items:3,
            loop:false
            }
      }
    });

    });

  </script>
  </body>
</html>
