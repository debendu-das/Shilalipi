<?php include_once 'includes/pdo.php'; ?>
<?php

$limit = 0;
$limitend = $limit+4;
$page = 1;

if (isset($_GET['page'])) {
  if (($_GET['page'] == 0 ) || ($_GET['page'] == 1 )) {
    header('Location: ./index.php');
    return;
  }

  $page = $_GET['page'];
  $limitend = $page*4;
  $limit = $limitend - 4;
}


$sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, users.user_id, users.name, users.user_img FROM blog JOIN users Where blog.user_id = users.user_id ORDER BY blog_view DESC LIMIT $limit, 4 ";
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
          <span class="author mr-2"><img src="admin/<?php echo $row['user_img'];?>" alt="User Name"> <?php echo($row['name']); ?></span>&bullet;
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

<div class="row mt-5">
  <div class="col-md-12 text-center">
    <nav aria-label="Page navigation" class="text-center">
      <ul class="pagination">
        <li class="page-item  active"><a class="page-link" href="index.php?page=<?= $page-1 ?>">&lt;</a></li>
        <li class="page-item"><a class="page-link" href="index.php">1</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=2">2</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=3">3</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=4">4</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=5">5</a></li>
        <li class="page-item"><a class="page-link" href="index.php?page=<?= $page+1 ?>">&gt;</a></li>
      </ul>
    </nav>
  </div>
