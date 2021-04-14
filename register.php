<?php

require_once "./includes/header.php";

$account = new Account($con);

if(isset($_POST["agree"])){
	if($account->register($_POST["username"],$_POST["password"],$_POST["firstname"],$_POST["lastname"],$_POST["email"])){
		header("Location: index.php");
	}
}

?>

	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Register</h4>
			</div>

			<!-- Modal body -->
			<div class="modal-body">

				<?php
					$before = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>';
					$after = '</div>';
					echo $account->getError(Account::$registerFailed, $before, $after);
				?>
				<form method="post" class="needs-validation" novalidate>
					<div class="form-group">
						<label for="fname">Firstname:</label>
							<input type="text" class="form-control" id="fname" placeholder="Enter given name" name="firstname" value="<?php echo htmlspecialchars($_POST['firstname'] ?? '', ENT_QUOTES); ?>" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="lname">Lastname:</label>
							<input type="text" class="form-control" id="lname" placeholder="Enter surname" name="lastname" value="<?php echo htmlspecialchars($_POST['lastname'] ?? '', ENT_QUOTES); ?>" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="uname">Username:</label>
							<input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<div class="form-group form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" name="agree" <?php echo (isset($_POST["agree"]) && $_POST["agree"] === "on")? "checked":""; ?> required> I agree to the terms and conditions.
							<div class="invalid-feedback">By signing up, you agreee to our terms and conditions.</div>
						</label>
					</div>
					<button type="submit" class="btn btn-primary">Sign Up</button>
					<hr>
					<p>Already have an account? <a href="login.php">Sign In</a></p>
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