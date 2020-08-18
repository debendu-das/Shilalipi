<?php
$stmt = $pdo->query("SELECT tag_id, tag_name FROM tag WHERE used > 0 ORDER BY used DESC LIMIT 10 ");
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $tag_id = $row['tag_id'];
      $tag_title = $row['tag_name'];
?>


    <li><a href="tags.php?tag_name=<?= $tag_title ?>"><?= $tag_title ?></a></li>

<?php } ?>
