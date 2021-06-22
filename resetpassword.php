<?php include('templates/header.php') ?>
<link rel="stylesheet" href="/css/login.css">

<body>
	<section class="h-100">
		<div class="container h-500">
			<div class="row justify-content-sm-center h-500">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 mt-5"><br><br>

					<div id="loginCard" class="card shadow-sm">
						<div class="card-body p-8">
							<h1 class="fs-4 card-title fw-bold mb-4">Reset Password</h1>
							<form method="POST" class="needs-validation" action="resetchecker.php" onsubmit="return checkPassword()">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">New Password</label>
									<input id="password" type="password" class="form-control" name="password" value="" required autofocus>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password-confirm">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirm" required>
									<div class="invalid-feedback">
										Please confirm your new password
									</div>
								</div>

								<div class="d-flex align-items-center">

									<button id="submit-button" type="submit" class="btn btn-primary ms-auto btn-block">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


</body>

<?php include('templates/footer.php') ?>

<script>
	var input1 = document.getElementById("password");
	var input2 = document.getElementById("password-confirm");

	function checkPassword() {
		if (input1.value != input2.value) {
			alert("Password did not match.");
			return false;

		} else {
			return true;
		}
	}
</script>