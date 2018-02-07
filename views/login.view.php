<!DOCTYPE html>
<html lang="en">
	<?php require "partials/head.php"; ?>
	<body>
		<?php require "partials/nav.php"; ?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 col-l-5 col-xl-5 mx-auto">
					<div class="card my-5">
					  <div class="card-body">
						<h3 class="text-center p-3">Prisijungimas</h3>
						<?php if (isset($_SESSION['error'])) : ?>
							<?php require "partials/error.php"; ?>
						<?php endif; ?>
						<div id="message"></div>
						<form method="POST" action="index.php" id="login_form">
							<div class="form-group">
								<label>Vardas</label>
								<input id="name" class="form-control" type="text" name="name" placeholder="Vardas">
							</div>
							<div class="form-group">
								<label>Slaptažodis</label>
								<input id="password" class="form-control" type="password" name="password" placeholder="Slaptažodis">
							</div>
							<input class="btn btn-success text-center col-12" type="submit" name="login" value="Prisijungti">
						</form>
					  </div>
					</div>
				</div>
			</div>
		</div>

		<?php require "partials/scripts.php"; ?>
	</body>
</html>