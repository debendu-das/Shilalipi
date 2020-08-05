<?php include 'pdo.php';?>

<?php
// if (isset($_POST['email']) && isset($_POST['password'])) {
//   $validemail = false ;
//   $email = $_POST['email'];
//   $pass = $_POST['password'];
//   $sql = " SELECT user_id, email, password FROM users WHERE email = '$email' AND password = '$pass' ";
//   $stmt = $pdo->query($sql);
//   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     $validemail = true ;
//     $_SESSION['user_id'] = $row['user_id'];
//     header('location:' . $_SESSION['redirectURL']);
//     return;
//   }
// }

?>


<div class="card-body">
  <h4 class="card-title">Login</h4>
  <form method="POST" class="my-login-validation" novalidate="">
    <div class="form-group">
      <label for="email">Email Id</label>
      <input id="email" type="email" class="form-control" name="login_email" value="" required autofocus>
      <div class="invalid-feedback">
        Email is invalid
      </div>
    </div>

    <div class="form-group">
      <label for="password">Password
        <a href="login.php?forget" class=" ml-5">
          Forgot Password?
        </a>
      </label>
      <input id="password" type="password" class="form-control" name="login_password" required data-eye>
        <div class="invalid-feedback">
          Password is required
        </div>
    </div>

    <div class="form-group m-0">
      <button type="submit" class="btn btn-primary btn-block">
        Login
      </button>
    </div>
    <div class="mt-4 text-center">
      Don't have an account? <a href="login.php?signup">Create One</a>
    </div>
  </form>
</div>
