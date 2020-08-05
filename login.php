<?php include 'includes/pdo.php';
session_start();

if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
  $validemail = false ;
  $email = $_POST['login_email'];
  $pass = $_POST['login_password'];
  $sql = " SELECT * FROM users WHERE email = '$email' AND password = '$pass' ";
  $stmt = $pdo->query($sql);
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $validemail = true ;
    $_SESSION['user_id'] = $row['user_id'];
    header('location:' . $_SESSION['redirectURL']);
    return;
  }
}

if (isset($_GET['signup'])) {
  if (isset($_POST['email'])) {
  	$email = $_POST['email'];
  	$sql1 = "SELECT user_id FROM users WHERE email = '$email' ";
  	$stmt = $pdo->query($sql1);
  	$row = $stmt->fetch(PDO::FETCH_ASSOC);
  	if ($row) {
  		$_SESSION['error'] = "Email already registered, Try with another Email";
      header( 'Location: ./login.php?signup');
      return;
  	}else{
      $user_img = $_FILES['user_img']['name'];
      $folder ='admin/uploads/';
      $user_img = $_FILES['user_img']['name'];
      $newname = $folder . time() ."-". rand(1000, 9999). $user_img ;
      $target_file=$folder.basename($_FILES["user_img"]["name"]);
      $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

      move_uploaded_file( $_FILES['user_img'] ['tmp_name'], $newname);

      $sql = "INSERT INTO users ( email, name, password, user_img, user_description )
      				VALUES ( :email, :name, :password, :user_img, :user_description ) ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
      		':email' => $_POST['email'],
      		':name' => $_POST['name'],
      		':password' => $_POST['password'],
      		':user_img' => $newname,
      		':user_description' => $_POST['user_description']));
      //blog_id
      $user_id = $pdo->lastInsertId();
      $_SESSION['success'] = "Enter your new email id and password";
      header( 'Location: ./login.php');
      return;
    }
  }
}



?>

<?php
include_once "./includes/head.php";
?>
<body>
  <div class="wrap">
    <?php include_once "./includes/header.php"; ?>

    <div class="container">
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
    </div>

        <section class="h-100">
      		<div class="container h-100 pt-5 pb-5">
      			<div class="row justify-content-center h-100">
      				<div class="card-wrapper">
      					<div class="card fat">
                  <?php

                    if (isset($_GET['signup'])) {
                      include_once "./includes/signup.php";
                    }elseif (isset($_GET['forget'])) {
                      include_once "./includes/forget.php";
                    }elseif(isset($_GET['reset'])){
                      include_once "./includes/forget.php";
                    }else {
                      include_once "./includes/signin.php";
                    }

                   ?>
      					</div>

      				</div>
      			</div>
      		</div>
    </section>

    <?php include_once "./includes/footer.php"; ?>
  </div>
  <?php include_once "./includes/scripts.php"; ?>
  <script src="js/my-login.js"></script>
  <script>
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
              else
              {

                  // Image preview
                  if (fileInput.files && fileInput.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                          document.getElementById(
                              'imagePreview').innerHTML =
                              '<img src="' + e.target.result
                              + '"/>';
                      };

                      reader.readAsDataURL(fileInput.files[0]);
                  }
              }
          }
      </script>

</body>
