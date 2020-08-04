<div class="card-body">
	<h4 class="card-title">Reset Password</h4>
	<form method="POST" class="my-login-validation" novalidate="">
		<div class="form-group">
			<label for="new-password">New Password</label>
			<input id="new-password" type="password" class="form-control" name="password" required autofocus data-eye>
			<div class="invalid-feedback">
				Password is required
			</div>
			<div class="form-text text-muted">
				Make sure your password is strong and easy to remember
			</div>
		</div>

		<div class="form-group m-0">
			<button type="submit" class="btn btn-primary btn-block">
				Reset Password
			</button>
		</div>
	</form>
</div>
