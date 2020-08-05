<?php include 'pdo.php';?>

<?php
$fetched = false ;
$sql = " SELECT blog.blog_id, blog.blog_title, blog.blog_img, blog.blog_content, blog.blog_date, blog.user_id, blog.cat_id, categorie.cat_name, users.name, users.user_img FROM blog JOIN categorie JOIN users ON blog.cat_id = categorie.cat_id AND blog.user_id = users.user_id AND blog_id = $blogid ";
$stmt = $pdo->query($sql);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $fetched = true ;
  $blogcat = $row['cat_name'];
  $sql3 = " SELECT comment_id FROM comments WHERE blog_id = '$blogid' ";
  $stmt2 = $pdo->query($sql3);
  $count = $stmt2->rowCount();
?>

    <img src="./admin/<?= $row['blog_img'] ?>" alt="Image" class="img-fluid mb-5">
     <div class="post-meta">
        <span class="author mr-2"><img src="<?= $row['user_img'] ?>" alt="Colorlib" class="mr-2"> <?= $row['name'] ?></span>&bullet;
        <span class="mr-2"><?= $row['blog_date'] ?> </span> &bullet;
        <span class="ml-2"><span class="fa fa-comments"></span> <?= $count ?></span>
      </div>
    <h1 class="mb-4"><?= $row['blog_title'] ?></h1>
    <a class="category mb-5" href="category.php"><?= $row['cat_name'] ?></a>

    <div class="post-content-body">
      <?= $row['blog_content'] ?>
    </div>

<?php }

if (!$fetched) {
  $_SESSION['error'] = "Invalid Blog";
  header('Location: index.php');
  return;
}

?>

<div class="pt-5">
  <p>Categories:  <a href="category.php"><?= $blogcat ?></a> Tags:

  <?php
    $sql = " SELECT tag.tag_id, tag.tag_name FROM tag JOIN blogtags ON blogtags.tag_id = tag.tag_id AND blogtags.blog_id = $blogid ";
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  ?>
     <a href="tags.php">#<?= $row['tag_name'] ?></a>

<?php } ?>
  </p>
</div>
