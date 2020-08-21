<?php include_once 'includes/pdo.php'; ?>

<?php
session_start();

$user_id = $_SESSION['user_id'] + 0;
$user_name = $_SESSION['user_name'];

if (isset($_POST['editname'])) {
  $sqlupdate = "UPDATE users SET name = :name WHERE user_id = :user_id ";
  $stmtupdate = $pdo->prepare($sqlupdate);
  $stmtupdate->execute(array(
    ':name' => $_POST['name'],
    ':user_id' => $user_id ));
    $_SESSION["success"] = "Name Updated";
    header('Location: settings.php');
    return;
}
if (isset($_POST['editemail'])) {
  $sqlupdate = "UPDATE users SET email = :email WHERE user_id = :user_id ";
  $stmtupdate = $pdo->prepare($sqlupdate);
  $stmtupdate->execute(array(
    ':email' => $_POST['email'],
    ':user_id' => $user_id ));
    $_SESSION["success"] = "Email Id Updated";
    header('Location: settings.php');
    return;
}
if (isset($_POST['editpassword'])) {
  $sql="SELECT password FROM users WHERE user_id = $user_id";
  $stmt = $pdo->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['password']!=$_POST['oldpassword']){
    $_SESSION["error"] = "Wrong Password";
    header('Location: settings.php');
    return;
  }
  $sqlupdate = "UPDATE users SET password = :password WHERE user_id = :user_id ";
  $stmtupdate = $pdo->prepare($sqlupdate);
  $stmtupdate->execute(array(
    ':password' => $_POST['newpassword'],
    ':user_id' => $user_id ));
    $_SESSION["success"] = "Password Updated";
    header('Location: settings.php');
    return;
}

if (isset($_POST['editimage'])) {
  $user_img = $_FILES['user_img']['name'];
  $folder ='admin/uploads/';
  $user_img = $_FILES['user_img']['name'];
  $newname = $folder . time() ."-". rand(1000, 9999). $user_img ;
  $target_file=$folder.basename($_FILES["user_img"]["name"]);
  $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

  move_uploaded_file( $_FILES['user_img'] ['tmp_name'], "../".$newname);
  $sqlupdate = "UPDATE users SET user_img = :user_img WHERE user_id = :user_id ";
  $stmtupdate = $pdo->prepare($sqlupdate);
  $stmtupdate->execute(array(
    ':user_img' => $newname,
    ':user_id' => $user_id ));
    $_SESSION["success"] = "Profile Picture Updated";
    header('Location: settings.php');
    return;
}
if (isset($_POST['editdescription'])) {
  $sqlupdate = "UPDATE users SET user_description = :user_description WHERE user_id = :user_id ";
  $stmtupdate = $pdo->prepare($sqlupdate);
  $stmtupdate->execute(array(
    ':user_description' => $_POST['user_description'],
    ':user_id' => $user_id ));
    $_SESSION["success"] = "Description Updated";
    header('Location: settings.php');
    return;
}


$sql="SELECT * FROM users WHERE user_id = $user_id";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC)
?>
<?php include 'includes/header.php';?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

          <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        <?= $_SESSION['user_name'] ?>'s Settings
                    </h1>
                </div>
                <div class="col-sm-8">
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
                    <div class="h4">
                      <label for="name">Name :</label>
                      <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" disabled>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editname">Change</button></td>
                    </div>

                    <div class="modal fade" id="editname" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Change your name</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="settings.php" method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-10 ml-2">
                                  <label for="name">Name</label>
                                  <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editname" value="Change"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
				        </div>
          <!-- email -->
                <div class="col-sm-8">
                    <div class="h4">
                      <label for="name">Email Id :</label>
                      <input type="text" name="name" class="form-control" value="<?= $row['email'] ?>" disabled>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editemail">Change</button></td>
                    </div>

                    <div class="modal fade" id="editemail" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Change your email id</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="settings.php" method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-10 ml-2">
                                  <label for="name">Email Id</label>
                                  <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editemail" value="Change"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
				        </div>

            <!-- Password -->
                <div class="col-sm-8">
                    <div class="h4">
                      <label for="name">Password :</label>
                      <input type="text" name="name" class="form-control" value="*********" disabled>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editpassword">Change</button></td>
                    </div>

                    <div class="modal fade" id="editpassword" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Change your password</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="settings.php" name="pass" method="post" onsubmit="return validateForm()">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-10 ml-2">
                                  <label for="name">Password</label>
                                  <input type="text" name="oldpassword" class="form-control" placeholder="Enter old password" required>
                              </div>
                              <div class="col-10 ml-2">
                                  <label for="name">Password</label>
                                  <input type="password" name="newpassword" class="form-control" placeholder="Enter new password" required>
                              </div>
                              <div class="col-10 ml-2">
                                  <label for="name">Password</label>
                                  <input type="password" name="newpassword2" class="form-control" placeholder="Re-Enter new password" required>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editpassword" value="Change"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
				        </div>

                <!-- Image -->
                <div class="col-sm-8">
                    <div class="h4">
                      <label for="name">Profile Picture :</label>
                    </div>
                    <div class="h4">
                      <img src="../<?= $row['user_img'] ?>" alt="User Image" class="img-fluid" style="width:30%">
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editimage">Change</button></td>

                    <div class="modal fade" id="editimage" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Change your Profile Picture</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="settings.php" enctype="multipart/form-data" method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-10 ml-2">
                                  <label for="name">Profile Picture</label>
                              </div>
                              <div class="col-10 ml-2">
                                <input type="file" class="form-control" id="file" name="user_img"
                          			        onchange="return fileValidation()" />
                              </div>
                              <div class="imagePreview">

                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editimage" value="Change"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
				        </div>

                <!-- user_image -->
                <div class="col-sm-8">
                    <div class="h4">
                      <label for="name">Description :</label>
                      <textarea name="name" class="form-control" disabled><?= $row['user_description'] ?></textarea>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editdescription">Change</button></td>
                    </div>

                    <div class="modal fade" id="editdescription" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="editModalLabel">Change your Description</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form  action="settings.php" method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-10 ml-2">
                                  <label for="description">Description</label>
                                  <textarea name="user_description" class="form-control" required><?= $row['user_description'] ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="editdescription" value="Change"  class="btn btn-primary">
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
				        </div>




            </div>
          </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    function validateForm() {
      var x = document.forms["pass"]["newpassword"].value;
      var y = document.forms["pass"]["newpassword2"].value;
      if (x.localeCompare(y)!=0) {
        alert("New Password Doesn't Match");
        return false;
      }
    }
      function fileValidation() {
          var fileInput =
              document.getElementById('file');

          var filePath = fileInput.value;

          // Allowing file type
          var allowedExtensions =
                  /(\.jpg|\.jpeg|\.png)$/i;

          if (!allowedExtensions.exec(filePath)) {
              alert('Only Jpg, Jpeg & Png type file allowed');
              fileInput.value = '';
              return false;
          }
      }
    </script>
</body>

</html>
