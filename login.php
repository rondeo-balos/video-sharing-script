<?php

require_once "./includes/header.php";

$account = new Account($con);

if(isset($_POST["username"])){
	if($account->login($_POST["username"],$_POST["password"])){
		header("Location: index.php");
	}
}

?>

	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Login</h4>
			</div>

			<!-- Modal body -->
			<div class="modal-body">

				<?php echo $account->getError(Account::$loginFailed) ?>
				<form method="post" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="uname">Username:</label>
							<input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" name="remember" > Remember Me
						</label>
					</div>
					<button type="submit" class="btn btn-primary">Sign in</button>
					<hr>
					<p>Don't have an account? <a href="register.php">Sign Up</a></p>
				</form>

			</div>

		</div>
	</div>

	<script>
		// Disable form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Get the forms we want to add validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
	</script>

<?php

require_once "./includes/footer.php";

?>