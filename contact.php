<?php include_once 'includes/pdo.php';
session_start();
include 'includes/redirectlogin.php';

if (isset($_POST['feedback'])) {
  $sql = "INSERT INTO feedback ( name, phone, email, message )
          VALUES ( :name, :phone, :email, :message ) ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':name' => $_POST['name'],
      ':phone' => $_POST['phone'],
      ':email' => $_POST['email'],
      ':message' => $_POST['message'] ));

  $_SESSION['success'] = "Message Submitted";
  header('location : contact.php');
  return;
}
?>

<?php
include_once "./includes/head.php";
?>
  <body>


    <div class="wrap">

      <?php $active='contact'; include_once "./includes/header.php"; ?>

    <section class="site-section pt-5">
      <div class="container">
        <div class="row mt-2">
          <?php include_once "./includes/flash.php"; ?>
        </div>
        <div class="row mb-4">
          <div class="col-md-6">
            <h1>Contact Me</h1>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">

            <form action="contact.php" method="POST" class="my-login-validation" novalidate="">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" class="form-control" required autofocus>
                      <div class="invalid-feedback">
                				Name is required
                			</div>
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="phone">Phone</label>
                      <input type="tel" id="phone" name="phone" placeholder="9876543210" pattern="[0-9]{10}" maxlength="12" class="form-control" required>
                      <div class="invalid-feedback">
                        Phone number must be integer and 10 digits
                      </div>
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" required>
                      <div class="invalid-feedback">
                				Email Id is required
                			</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="message">Write Message</label>
                      <textarea name="message" id="message" class="form-control " cols="30" rows="8" minlength="25" maxlength="1000" required></textarea>
                      <div class="invalid-feedback">
                        Hahaha! Is you forget to write some message ? write minimum 25 letters and max 1000 letters.
                			</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="submit" name="feedback" value="Send Message" class="btn btn-primary">
                    </div>
                  </div>
                </form>


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
  <script src="js/my-login.js"></script>

  </body>
</html>
