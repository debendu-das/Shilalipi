<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $limit = ($page*6) - 6;
}else {
  $limit = 0;
  $page = 1;
}

if (isset($_GET['cat_name'])) {
  $catname = $_GET['cat_name'];
  $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, users.name, users.user_img, categorie.cat_name FROM blog JOIN users JOIN categorie ON blog.user_id = users.user_id AND blog.cat_id = categorie.cat_id AND categorie.cat_name = '$catname' ORDER BY blog_id DESC LIMIT $limit, 6";
}else {
  $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, users.name, users.user_img, categorie.cat_name FROM blog JOIN users JOIN categorie ON blog.user_id = users.user_id AND blog.cat_id = categorie.cat_id ORDER BY RAND() LIMIT $limit, 6";
}

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

<?php } ?>
