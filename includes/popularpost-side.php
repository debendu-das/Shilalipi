<?php include_once 'pdo.php' ?>

<?php
  $sql1 = "SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_date FROM blog ORDER BY blog_view DESC LIMIT $limit, 4 ";
  $stmt = $pdo->query($sql1);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>

<div class="post-entry-sidebar">
  <ul>
    <li>
      <a href="index.php?blog=<?php echo($row['blog_id']); ?>">
        <img src="admin/<?php echo $row['blog_img'];?>" alt="Image placeholder" class="mr-4">
        <div class="text">
          <h4><?php echo($row['blog_title']); ?></h4>
          <div class="post-meta">
            <span class="mr-2"><?php echo($row['blog_date']); ?> </span>
          </div>
        </div>
      </a>
    </li>
  </ul>
</div>

<?php } ?>
