<header role="banner">
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-6 social">
          <a href="https://twitter.com"><span class="fa fa-twitter"></span></a>
          <a href="https://facebook.com"><span class="fa fa-facebook"></span></a>
          <a href="https://instagram.com"><span class="fa fa-instagram"></span></a>
          <a href="https://youtube.com"><span class="fa fa-youtube-play"></span></a>
        </div>
        <div class="col-6 search-top">
          <!-- <a href="#"><span class="fa fa-search"></span></a> -->
          <form action="search.php" method="GET" class="search-top-form">
            <span class="icon fa fa-search"></span>
            <input type="text" name="search" id="s" placeholder="Type keyword to search..." required>
          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="container logo-wrap">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
        <h1 class="site-logo"><a href="index.php">Shilalipi</a></h1>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">


      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link <?php if($active=='home')echo "active"; ?>" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='popular')echo "active"; ?>" href="popular.php">Popular</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($active=='categories')echo "active"; ?>" href="category.php" >Categories</a>

          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='about')echo "active"; ?>" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($active=='contact')echo "active"; ?>" href="contact.php">Contact</a>
          </li>
          <?php if (isset($_SESSION['user_name'])) { ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
              <div class="dropdown-menu" aria-labelledby="dropdown05">
                <a class="dropdown-item" href="./admin/">Dashboard</a>
                <a class="dropdown-item" href="./admin/posts.php">Posts</a>
                <a class="dropdown-item" href="./admin/profile.php">Account</a>
                <a class="dropdown-item" href="index.php?logout">Log out</a>
              </div>
            </li>

          <?php }else { ?>
          <li class="nav-item">
            <a class="nav-link" href=<?php echo " './login.php' >Login </a>"; ?>
          </li>
        <?php } ?>
        </ul>

      </div>
    </div>
  </nav>
</header>
