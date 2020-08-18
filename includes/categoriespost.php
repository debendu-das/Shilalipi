<?php
$stmt = $pdo->query("SELECT cat_id, cat_name, used FROM categorie WHERE used > 0  ORDER BY used DESC LIMIT 5 ");
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_name'];
    $used = $row['used'];
?>
    <li><a href="category.php?cat_name=<?= $cat_title ?>"><?= $cat_title ?> <span>(<?= $used ?>)</span></a></li>
<?php } ?>
