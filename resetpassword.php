<?php include('templates/header.php') ?>

<body>
	<section class="h-100">
		<div class="container h-500">
			<div class="row justify-content-sm-center h-500">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
				
					</div>
					<div class="card shadow-sm">
						<div class="card-body p-8">
							<h1 class="fs-4 card-title fw-bold mb-4">Reset Password</h1>
							<form method="POST" class="needs-validation" action="resetchecker.php" novalidate="" autocomplete="off">
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
									
									<button type="submit" class="btn btn-primary ms-auto">
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