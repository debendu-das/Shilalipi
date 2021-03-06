<?php include_once 'includes/pdo.php'; ?>
<?php

if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $limit = ($page*6) - 6;
}else {
  $limit = 0;
  $page = 1;
}


$sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, users.user_id, users.name, users.user_img FROM blog JOIN users Where blog.user_id = users.user_id ORDER BY blog_view DESC LIMIT $limit, 6 ";
$stmt = $pdo->query($sql1);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $blogid = $row['blog_id'];
  $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
  $stmt2 = $pdo->query($sql3);
  $count = $stmt2->rowCount();

?>


 <!-- single post -->
  <div class="col-md-6">
    <a href="blog-single.php?blog_id=<?= $row['blog_id'] ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
      <img src="admin/<?php echo $row['blog_img'];?>" alt="Image placeholder">
      <div class="blog-content-body">
        <div class="post-meta">
          <span class="author mr-2"><img src="<?php echo $row['user_img'];?>" alt="User Name"> <?php echo($row['name']); ?></span>&bullet;
          <span class="mr-2"><?php echo($row['blog_date']); ?> </span> &bullet;
          <span class="ml-2"><span class="fa fa-comments"></span> <?php echo($count); ?></span>
        </div>
        <h2><?php echo($row['blog_title']); ?></h2>
      </div>
    </a>
  </div>

<?php
}
 ?>

<div class="row mt-5 mx-auto">
  <div class="col-md-12 text-center">
    <nav aria-label="Page navigation" class="text-center">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="popular.php?page=<?= $page>1 ? $page-1 : $page  ?>" >&lt;</a></li>
        <li class="page-item <?php if($page==1) echo ('active'); ?>"><a class="page-link" href="popular.php">1</a></li>
        <li class="page-item <?php if($page==2) echo ('active'); ?>"><a class="page-link" href="popular.php?page=2">2</a></li>
        <li class="page-item <?php if($page==3) echo ('active'); ?>"><a class="page-link" href="popular.php?page=3">3</a></li>
        <li class="page-item <?php if($page==4) echo ('active'); ?>"><a class="page-link" href="popular.php?page=4">4</a></li>
        <li class="page-item <?php if($page==5) echo ('active'); ?>"><a class="page-link" href="popular.php?page=5">5</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=<?= $page+1 ?>">&gt;</a></li>
      </ul>
    </nav>
  </div>
