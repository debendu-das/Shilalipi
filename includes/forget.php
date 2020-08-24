<div class="card-body">
	<h4 class="card-title">Forgot Password</h4>
<?php if (!isset($_GET['user_id'])) { ?>
	<form method="POST" class="my-login-validation" action="login.php?forget" novalidate="">
		<div class="form-group">
			<label for="email">E-Mail Address</label>
			<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
			<div class="invalid-feedback">
				Email is invalid
			</div>
			<label for="dob">Date Of Birth</label>
			<input id="dob" type="date" class="form-control" name="dob" value="" required>
			<div class="invalid-feedback">
				Date Of Birth Required
			</div>
			<div class="form-text text-muted">
				By clicking "Reset Password" we will send a password reset link
			</div>
		</div>

		<div class="form-group m-0">
			<button type="submit" name="forget" class="btn btn-primary btn-block">
				Reset Password
			</button>
		</div>
	</form>
<?php }else{
	$user_id = $_GET['user_id'] + 0;
	$sql1 = "SELECT name FROM users WHERE user_id = $user_id ";
	$stmt = $pdo->query($sql1);
	$nameuser = $stmt->fetch(PDO::FETCH_ASSOC)
	 ?>
	 <div class="form-group">
	 	Hello! <span style="color:black"> <?= $nameuser['name'] ?></span> Please set your new password here.
	 </div>
	<form method="POST" name="pass" class="my-login-validation" action="login.php?forget&user_id=<?= $user_id ?>" novalidate="" onsubmit="return validateForm()">
		<div class="form-group">
			<label for="password">New Password</label>
			<input id="password" type="password" class="form-control" name="password" value="" required autofocus>
			<div class="invalid-feedback">
				Password is required
			</div>
			<label for="newpassword">Re-enter New Password</label>
			<input id="password2" type="password" class="form-control" name="password2" value="" required>
			<div class="invalid-feedback">
				Password is not same
			</div>
		</div>

		<div class="form-group m-0">
			<button type="submit" name="resetpassword" class="btn btn-primary btn-block">
				Reset Password
			</button>
		</div>
	</form>
<?php } ?>
</div>
