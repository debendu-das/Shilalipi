<?php
$stmt = $pdo->query("SELECT tag_id, tag_name FROM tag ORDER BY used DESC LIMIT 5 ");
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $tag_id = $row['tag_id'];
      $tag_title = $row['tag_name'];
?>


    <li><a href="category.html?<?= $tag_id ?>"><?= $tag_title ?></a></li>

<?php } ?>
