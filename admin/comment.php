<?php include_once 'includes/pdo.php'; ?>
<?php session_start();
$user_id = $_SESSION['user_id']+0;
$user_name = $_SESSION['user_name'];

if(isset($_POST['editcomment'])){
  $edit_id = $_POST['comment_id']+0;

  $sql2 = "SELECT comment_id FROM comments WHERE comment_id = $edit_id ";
  $stmt = $pdo->query($sql2);
  if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
    $sql = "UPDATE comments SET comment_content = :comment_content WHERE comment_id = $edit_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
          ':comment_content' => $_POST['comment_content'] ));
    $_SESSION['success'] = 'Comment Edited';
    header( 'Location: comment.php' ) ;
    return;
  }else {
    $_SESSION['error'] = 'Invalid Comment';
    header( 'Location: comment.php' ) ;
    return;
  }
}
if(isset($_POST['deletecomment'])){
  $edit_id = $_POST['comment_id']+0;

  $sql="DELETE FROM comments WHERE comment_id = :comment_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':comment_id' => $edit_id));
  $_SESSION['success'] = 'Comment Deleted';
  header( 'Location: comment.php' ) ;
  return;
}

?>

<?php include 'includes/header.php'; ?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

          <div class="row">
    					<h1 class="page-header text-center">
    						<?= $_SESSION['user_name'] ?>'s Comments
    					</h1>
    			</div>
    			<div class="container-fluid">
            <div class="row">
              <?php
               if (isset($_SESSION['error'])) {
                 echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
                 unset($_SESSION["error"]);
               }
               if (isset($_SESSION['success'])) {
                 echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
                 unset($_SESSION["success"]);
               }
               ?>
            </div>

            <div class="row">
              <div class="h3">
                Your Comments :
              </div>
              <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <th>Comment No.</th>
                    <th>Blog Title</th>
                    <th>Blog Image</th>
                    <th>Comment Content</th>
                    <th>Comment Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </thead>
                  <tbody>
                  <?php

                  $num=1;
                  $sql1 = "SELECT comments.comment_id, blog.blog_title, blog.blog_img, comments.comment_content, comments.comment_date FROM blog JOIN comments ON blog.blog_id = comments.blog_id AND comments.user_id = $user_id ORDER BY comment_id DESC";
                  $stmt = $pdo->query($sql1);
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>";
                    echo($num);
                    echo("</td><td>");
                    echo($row['blog_title']);
                    echo("</td><td>");
                    echo("<img src='");
                    echo($row['blog_img']);
                    echo(" ' style='width:80px;' >");
                    echo("</td><td>");
                    echo($row['comment_content']);
                    echo("</td><td>");
                    echo($row['comment_date']);
                    echo("</td>");
                    $comment_id = $row['comment_id'];
    								?>
    								<!-- Modal -->

                    <div class="modal fade" id="editModal<?=$comment_id ?>" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="deleteModalLabel">Edit Comment</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="comment.php" method="post">
                          <div class="modal-body">
                            <h4>Here is your comment! Edit if you like</h4>
                            <div>
                              <div class="row">
                                <div class="col-12 text-center">
                                  <img src="<?= $row['blog_img'] ?>" alt="Blog Image" style="width:30%">
                                </div>
                                <div class="col-12 text-center">
                                  <h3><?= $row['blog_title'] ?></h3>
                                </div>
                                <div class="col-10 text-center">
                                    <label for="comment">Your Comment</label>
                                    <input type="text" name="comment_id" value="<?= $row['comment_id'] ?>" hidden>
                                    <textarea class="form-control" name="comment_content"><?= $row['comment_content'] ?></textarea>
                                </div>
                              </div>

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editcomment" value="Edit"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>



    				<div class="modal fade" id="deleteModal<?=$comment_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    					<div class="modal-dialog" role="document">
    						<div class="modal-content">
    							<div class="modal-header">
    								<h3 class="modal-title" id="deleteModalLabel">Delete Confirmation</h3>
    								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    									<span aria-hidden="true">&times;</span>
    								</button>
    							</div>
                <form  action="comment.php" method="post">
    							<div class="modal-body">
    								<h4>Are you sure to delete this Comment?</h4>
    								<div>
    									<div class="row">
    										<div class="col-12 text-center">
    											<img src="<?= $row['blog_img'] ?>" alt="Blog Image" style="width:30%">
    										</div>
    										<div class="col-12 text-center">
    											<h3><?= $row['blog_title'] ?></h3>
    										</div>
    										<div class="col-12">
                          <h4>Your Comment:</h4>
                          <input type="text" name="comment_id" value="<?= $row['comment_id'] ?>" hidden>
                          <p class="text-center"><?= $row['comment_content'] ?></p>
    										</div>
    									</div>

    								</div>
    							</div>
    							<div class="modal-footer">
    								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="deletecomment" value="Confirm"  class="btn btn-danger">
    							</div>
                </form>
    						</div>
    					</div>
    				</div>
    			<?php
          echo "<td><button type='button' class='btn btn-primary'data-toggle='modal' data-target='#editModal$comment_id'>Edit</button></td>";
    			echo "<td><button type='button' class='btn btn-danger'data-toggle='modal' data-target='#deleteModal$comment_id'>Delete</button></td>";
    			echo "</tr>";
    			$num++;
    		} ?>
                  </tbody>
                  </table>

            </div>

    			</div>

    		</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
