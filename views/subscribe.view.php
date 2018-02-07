<!DOCTYPE html>
<html lang="en">
	<?php require "partials/head.php"; ?>
	<body>
		<?php require "partials/nav.php"; ?>

		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
					  <h1 class="prenumerata">Prenumerata</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 col-l-8 col-xl-8 mx-auto">
					<div class="card">
					  <div class="card-body">
						<?php if (isset($_SESSION['success'])) : ?>
							<?php require "partials/success.php"; ?>
						<?php endif; ?>
						<?php if (isset($_SESSION['error'])) : ?>
							<?php require "partials/error.php"; ?>
						<?php endif; ?>
						<div id="message"></div>
						<form method="POST" action="index.php" id="subscribe_form">
							<div class="form-group">
								<label>Vardas</label>
								<input id="name" class="form-control" type="text" name="name" placeholder="Vardas">
							</div>
							<div class="form-group">
								<label>El. paštas</label>
								<input id="email" class="form-control" type="text" name="email" placeholder="El. paštas">
							</div>
							<div class="form-group">
							   <select id="categories" name="select[]" multiple class="form-control">
								   <?php foreach ($categories as $category) : ?>
								  	 <option value="<?= $category[0]; ?>"><?= $category[0]; ?></option>
								   <?php endforeach; ?>
							   </select>
							   <small>Norėdami pasirinkti daugiau nei vieną kategoriją laikykite Ctrl</small>
							</div>
							<input class="btn btn-success text-center col-12" type="submit" name="subscribe" value="Prenumeruoti">
						</form>
					  </div>
					</div>
				</div>
			</div>
		</div>

		<?php require "partials/scripts.php"; ?>
	</body>
</html>