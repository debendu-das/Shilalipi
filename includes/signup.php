<?php

// if (isset($_GET['signup'])) {
//   if (isset($_POST['email'])) {
//   	$email = $_POST['email'];
//   	$sql1 = "SELECT user_id FROM users WHERE email = '$email' ";
//   	$stmt = $pdo->query($sql1);
//   	$row = $stmt->fetch(PDO::FETCH_ASSOC);
//   	if ($row) {
//   		$_SESSION['error'] = "Email already registered, Try with another Email";
//       header( 'Location: ./login.php?signup');
//       return;
//   	}else{
//       $user_img = $_FILES['user_img']['name'];
//       $folder ='admin/uploads/';
//       $user_img = $_FILES['user_img']['name'];
//       $newname = $folder . time() ."-". rand(1000, 9999). $user_img ;
//       $target_file=$folder.basename($_FILES["user_img"]["name"]);
//       $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
//
//       move_uploaded_file( $_FILES['user_img'] ['tmp_name'], $newname);
//
//       $sql = "INSERT INTO users ( email, name, password, user_img, user_description )
//       				VALUES ( :email, :name, :password, :user_img, :user_description ) ";
//       $stmt = $pdo->prepare($sql);
//       $stmt->execute(array(
//       		':email' => $_POST['email'],
//       		':name' => $_POST['name'],
//       		':password' => $_POST['password'],
//       		':user_img' => $newname,
//       		':user_description' => $_POST['user_description']));
//       //blog_id
//       $user_id = $pdo->lastInsertId();
//       $_SESSION['user_id'] = $user_id;
//       header('location:' . $_SESSION['redirectURL']);
//       return;
//     }
//
//   }
// }
//
?>
<div class="card-body">
	<h4 class="card-title">Register</h4>
	<form method="POST" enctype="multipart/form-data" class="my-login-validation" novalidate="">
		<div class="form-group">
			<label for="name">Name</label>
			<input id="name" type="text" class="form-control" name="name" required autofocus>
			<div class="invalid-feedback">
				What's your name?
			</div>
		</div>

		<div class="form-group">
			<label for="email">E-Mail Address</label>
			<input id="email" type="email" class="form-control" name="email" required>
			<div class="invalid-feedback">
				Your email is invalid
			</div>
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input id="password" type="password" class="form-control" name="password" required data-eye>
			<div class="invalid-feedback">
				Password is required
			</div>
		</div>
		<div class="form-group">
			<label for="user_img">Profile Picture</label>
			<input type="file" class="form-control" id="file" name="user_img"
			        onchange="return fileValidation()" required/>
			<div class="invalid-feedback">
				Image is required
			</div>
		</div>

		<div class="form-group">
			<label for="user_description">Description</label>
			<textarea id="description" cols="30" class="form-control" name="user_description" required></textarea>
			<div class="invalid-feedback">
				Your Description is reuired
			</div>
		</div>

		<div class="form-group">
			<div class="custom-checkbox custom-control">
				<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
				<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
				<div class="invalid-feedback">
					You must agree with our Terms and Conditions
				</div>
			</div>
		</div>

		<div class="form-group m-0">
			<button type="submit" class="btn btn-primary btn-block">
				Register
			</button>
		</div>
		<div class="mt-4 text-center">
			Already have an account? <a href="login.php">Login</a>
		</div>
	</form>
</div>
