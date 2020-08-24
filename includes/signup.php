<?php
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
			<label for="dob">Date Of Birth</label>
			<input id="dob" type="date" class="form-control" name="dob" placeholder="YYYY-MM-DD" required>
			<div class="invalid-feedback">
				Date Of Birth is required
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
			<button type="submit" name="signup" class="btn btn-primary btn-block">
				Register
			</button>
		</div>
		<div class="mt-4 text-center">
			Already have an account? <a href="login.php">Login</a>
		</div>
	</form>
</div>
