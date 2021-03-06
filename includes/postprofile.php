<?php
  include_once "pdo.php";

  $sql1 = " SELECT users.user_id, users.name, users.user_img, users.user_description FROM users JOIN blog ON blog.user_id = users.user_id AND blog.blog_id = $blogid ";
  $stmt = $pdo->query($sql1);
  while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
?>
  <div class="bio text-center">
    <img src="<?= $row['user_img'] ?>" alt="Image Placeholder" class="img-fluid">
    <div class="bio-body">
      <h2><?= $row['name'] ?></h2>
      <p><?= $row['user_description'] ?></p>
      <p><a href="users.php?user_id=<?=$row['user_id']?>" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
      <p class="social">
        <a href="https://www.facebook.com" class="p-2"><span class="fa fa-facebook"></span></a>
        <a href="https://www.twitter.com" class="p-2"><span class="fa fa-twitter"></span></a>
        <a href="https://www.instagram.com" class="p-2"><span class="fa fa-instagram"></span></a>
        <a href="https://www.youtube.com" class="p-2"><span class="fa fa-youtube-play"></span></a>
      </p>
    </div>
  </div>
<?php break; } ?>
