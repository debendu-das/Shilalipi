<?php include_once 'pdo.php';?>
<div id="owl-demo" class="owl-carousel owl-theme">

<?php
$sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, categorie.cat_name FROM blog JOIN categorie Where blog.cat_id = categorie.cat_id AND categorie.cat_name = '$blogcat' ORDER BY RAND() LIMIT 6 ";
$stmt = $pdo->query($sql1);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

<?php } ?>
</div>
