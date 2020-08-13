<?php
$stmt = $pdo->query("SELECT cat_name FROM categorie ORDER BY used DESC ");
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cat_title = $row['cat_name'];
?>

    <a href="category.php?cat_name=<?= $row['cat_name'] ?>" class="btn btn-primary btn-sm rounded m-1"><?= $row['cat_name'] ?></a>

<?php } ?>
