<header role="banner">
        <div class="top-bar">
          <div class="container">
            <div class="row">
              <div class="col-6 social">
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-instagram"></span></a>
                <a href="#"><span class="fa fa-youtube-play"></span></a>
              </div>
              <div class="col-6 search-top">
                <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                <form action="#" class="search-top-form">
                  <span class="icon fa fa-search"></span>
                  <input type="text" id="s" placeholder="Type keyword to search...">
                </form>
                <!-- <button class="btn btn-warning">Login</button> -->

              </div>
            </div>
          </div>
        </div>

        <div class="container logo-wrap">
          <div class="row pt-5">
            <div class="col-12 text-center">
              <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
              <h1 class="site-logo"><a href="index.html">Shilalipi</a></h1>
            </div>
          </div>
        </div>

        <nav class="navbar navbar-expand-md  navbar-light bg-light">
          <div class="container">


            <div class="collapse navbar-collapse" id="navbarMenu">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="popular.php">Popular</a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <?php
                      $stmt = $pdo->query("SELECT cat_id, cat_name FROM categorie ORDER BY used DESC LIMIT 5 ");
                       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_name'];
                            echo "<a class='dropdown-item' href='category.html?cat_id={$cat_id}'>";
                            echo "{$cat_title}</a>";
                        }
                     ?>
                  </div>

                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href=
                  <?php if (isset($_SESSION['user_id'])) {
                    echo " './admin/' >Dashboard </a>";
                  }else {
                    echo " './login.php' >Login </a>";
                  }

                   ?>
                </li>
              </ul>

            </div>
          </div>
        </nav>
      </header>
