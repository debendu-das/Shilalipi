<?php include_once 'pdo.php' ?>

<?php
  $sql1 = "SELECT blog_id, blog_title, blog_img, blog_date FROM blog ORDER BY blog_id DESC LIMIT 4 ";
  $stmt = $pdo->query($sql1);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>

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

<?php } ?>
