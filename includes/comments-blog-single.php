<?php include 'includes/pdo.php';?>
<?php
$sqlcomment = "SELECT comments.comment_id, comments.blog_id, comments.comment_content, comments.comment_date, users.user_id, users.name, users.user_img FROM comments JOIN users ON comments.blog_id = $blogid AND users.user_id = comments.user_id";
$stmtcomment = $pdo->query($sqlcomment);
while ($row = $stmtcomment->fetch(PDO::FETCH_ASSOC)) {
?>


<li class="comment">
  <div class="vcard">
    <img src="<?php echo $row['user_img'];?>" alt="Image placeholder">
  </div>
  <div class="comment-body">
    <h3><?php echo $row['name'];?></h3>
    <div class="meta"><?php echo $row['comment_date'];?></div>
    <p><?php echo $row['comment_content'];?></p>
    <!-- <p><a href="#" class="reply rounded">Reply</a></p> -->
  </div>
</li>

<?php } ?>
<!-- <ul class="children">
  <li class="comment">
    <div class="vcard">
      <img src="images/person_1.jpg" alt="Image placeholder">
    </div>
    <div class="comment-body">
      <h3>Jean Doe</h3>
      <div class="meta">January 9, 2018 at 2:21pm</div>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
      <p><a href="#" class="reply rounded">Reply</a></p>
    </div>
  </li>
</ul> -->
