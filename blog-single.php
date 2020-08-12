<?php include 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

?>

<?php
include_once "./includes/head.php";

if (!isset($_GET['blog_id'])) {
  $_SESSION['error'] = "Not Selected any Blog";
  header( 'Location: ./index.php');
  return;
}
?>
<?php
$blogid = $_GET['blog_id'];

$sql = "UPDATE blog SET blog_view = blog_view + 1 WHERE blog_id = :blog ";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
  ':blog' => $blogid));

  if (isset($_POST['comment_content'])) {
    $datetime = date("M d,Y h:ia");
    $sql = " INSERT INTO comments (blog_id, comment_content, comment_date, user_id) VALUES ( :blog_id, :comment_content, :comment_date, :user_id) ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':blog_id' => $blogid,
        ':comment_content' => $_POST['comment_content'],
        ':comment_date' => $datetime,
        ':user_id' => $_SESSION['user_id'] ));
    header( 'Location: ./blog-single.php?blog_id='.$blogid);
    return;
  }
?>
  <body>
    <div class="wrap">
      <?php include_once "./includes/header.php"; ?>



    <section class="site-section py-lg">
      <div class="container">

        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">

            <?php include_once "./includes/single-main.php"; ?>


            <div class="pt-5">
              <h3 class="mb-5">Comments</h3>
              <ul class="comment-list">
                <?php include "./includes/comments-blog-single.php"; ?>
              </ul>
              <!-- END comment-list -->

              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <?php
                  if (isset($_SESSION['user_id'])) {
                    include "./includes/commentform.php";
                  }else {
                    echo "You Need To <a href='login.php' class='link btn btn-outline-primary'>Login </a>  First<br><br>";
                  }

                  ?>

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
              <?php include "./includes/postprofile.php"; ?>

            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <div class="row">
                <div class="col-6">
                  <h3 class="heading">Popular Posts</h3>
                </div>
                <div class="col-6">
                  <a href="popular.php">See all</a>
                </div>
              </div>
              <div class="post-entry-sidebar">
                <ul>
                  <?php include_once "./includes/popularpost-side.php"; ?>
                </ul>
              </div>
            </div>

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

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">Related Post</h2>
          </div>
        </div>
        <div class="row">
          <?php include_once "./includes/relatedposts.php"; ?>

        </div>
      </div>


    </section>
    <!-- END section -->

    <?php include_once "./includes/footer.php"; ?>
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
    <script type="text/javascript">
    $(document).ready(function() {

      $("#owl-demo").owlCarousel({

          autoPlay: 3000, //Set AutoPlay to 3 seconds

          loop:true,
    margin:10,
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
