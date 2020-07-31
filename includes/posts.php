<?php include_once 'includes/pdo.php'; ?>
<?php
$sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date, users.user_id, users.name, users.user_img FROM blog JOIN users Where blog.user_id = users.user_id ORDER BY blog_id DESC";
$stmt = $pdo->query($sql1);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $stmt2 = $pdo->query(" SELECT comments.comment_id FROM comments JOIN blog WHERE blog.blog_id = comments.blog_id ");
  $count = $stmt2->rowCount();

?>


 <!-- single post -->
  <div class="col-md-6">
    <a href="blog-single.html" class="blog-entry element-animate" data-animate-effect="fadeIn">
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
        <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">4</a></li>
        <li class="page-item"><a class="page-link" href="#">5</a></li>
        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
      </ul>
    </nav>
  </div>
