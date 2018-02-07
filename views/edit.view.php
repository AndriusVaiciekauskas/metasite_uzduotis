<!DOCTYPE html>
<html lang="en">
	<?php require "partials/head.php"; ?>
	<body>
		<?php require "partials/nav.php"; ?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-6 mx-auto">
					<div class="card my-5">
					  <div class="card-body">
					  	<h3>Redaguoti</h3>
					  	<?php if (isset($_SESSION['error'])) : ?>
							<?php require "partials/error.php"; ?>
					  	<?php endif; ?>
					  	<div id="message"></div>
						<form method="POST" action="index.php" id="edit_form">
							<div class="form-group">
								<label>Vardas</label>
								<input id="name" class="form-control" type="text" name="name" placeholder="Name"  value="<?= $user[1]; ?>">
							</div>
							<div class="form-group">
								<label>El. paštas</label>
								<input id="email" class="form-control" type="text" name="email" placeholder="Email"  value="<?= $user[2]; ?>">
							</div>
							<input type="hidden" name="string" value="<?= $user[0] . ',' . $user[1] . ',' . $user[2]; ?>">
							<input class="btn btn-success" type="submit" name="edit" value="Redaguoti">
						</form>
					  </div>
					</div>
				</div>
			</div>
		</div>
		
		<?php require "partials/scripts.php" ?>
	</body>
</html>