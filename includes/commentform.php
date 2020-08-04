<?php

 ?>

<form method="POST" action="./blog-single.php?blog_id=<?= $blogid ?>" class="p-5 bg-light">

  <div class="form-group">
    <label for="message">Comment</label>
    <textarea name="comment_content" id="message" cols="30" rows="10" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <input type="submit" value="postcomment" class="btn btn-primary">
  </div>

</form>
