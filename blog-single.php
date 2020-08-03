<?php include 'includes/pdo.php';
session_start();
?>

<?php
include_once "./includes/head.php";

if (!isset($_GET['blog_id'])) {
  $_SESSION['error'] = "Not Selected any Blog";
  header( 'Location: ./index.php');
  return;
}

$blogid = $_GET['blog_id'];

$sql = "UPDATE blog SET blog_view = blog_view + 1 WHERE blog_id = :blog ";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
  ':blog' => $blogid));



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
                  else {
                    echo "You Need To Login";
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
              <div class="bio text-center">
                <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2>Craig David</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
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
          <div class="col-md-6 col-lg-4">
            <a href="#" class="a-block sm d-flex align-items-center height-md" style="background-image: url('images/img_2.jpg'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category">Lifestyle</span>
                  <span class="mr-2">March 15, 2018 </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a href="#" class="a-block sm d-flex align-items-center height-md" style="background-image: url('images/img_3.jpg'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category">Travel</span>
                  <span class="mr-2">March 15, 2018 </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a href="#" class="a-block sm d-flex align-items-center height-md" style="background-image: url('images/img_4.jpg'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category">Food</span>
                  <span class="mr-2">March 15, 2018 </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h3>There’s a Cool New Way for Men to Wear Socks and Sandals</h3>
              </div>
            </a>
          </div>
        </div>
      </div>


    </section>
    <!-- END section -->

    <footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3>About Us</h3>
              <p class="mb-4">
                <img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid">
              </p>

              <p>Lorem ipsum dolor sit amet sa ksal sk sa, consectetur adipisicing elit. Ipsa harum inventore reiciendis. <a href="#">Read More</a></p>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-7">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>
                      <li>
                        <a href="">
                          <img src="images/img_6.jpg" alt="Image placeholder" class="mr-4">
                          <div class="text">
                            <h4>How to Find the Video Games of Your Youth</h4>
                            <div class="post-meta">
                              <span class="mr-2">March 15, 2018 </span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="">
                          <img src="images/img_3.jpg" alt="Image placeholder" class="mr-4">
                          <div class="text">
                            <h4>How to Find the Video Games of Your Youth</h4>
                            <div class="post-meta">
                              <span class="mr-2">March 15, 2018 </span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="">
                          <img src="images/img_4.jpg" alt="Image placeholder" class="mr-4">
                          <div class="text">
                            <h4>How to Find the Video Games of Your Youth</h4>
                            <div class="post-meta">
                              <span class="mr-2">March 15, 2018 </span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-4">

                  <div class="mb-5">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                      <li><a href="#">About Us</a></li>
                      <li><a href="#">Travel</a></li>
                      <li><a href="#">Adventure</a></li>
                      <li><a href="#">Courses</a></li>
                      <li><a href="#">Categories</a></li>
                    </ul>
                  </div>

                  <div class="mb-5">
                    <h3>Social</h3>
                    <ul class="list-unstyled footer-social">
                      <li><a href="#"><span class="fa fa-twitter"></span> Twitter</a></li>
                      <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                      <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                      <li><a href="#"><span class="fa fa-vimeo"></span> Vimeo</a></li>
                      <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                      <li><a href="#"><span class="fa fa-snapchat"></span> Snapshot</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p class="small">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
        </div>
      </footer>
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
