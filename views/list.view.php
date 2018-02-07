<!DOCTYPE html>
<html lang="en">
	<?php require "partials/head.php"; ?>
	<body>
		<?php require "partials/nav.php"; ?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
					  <h1>Prenumeratorių sąrašas</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 mx-auto">
					<?php if (isset($_SESSION['success'])) : ?>
						<?php require "partials/success.php"; ?>
					<?php endif; ?>
					<?php if ($user_data == null) : ?>
						<h6>Prenumeratorių nėra</h6>
					<?php else : ?>
						<table class="table table-hover table-responsive-md">
							<tr>
								<th>Data</th>
								<th>Vardas</th>
								<th>El. paštas</th>
								<th>Kategorijos</th>
								<th>Veiksmas</th>
							</tr>
						<?php for ($i = $_SESSION['count']; $i < $_SESSION['count'] + 5; $i++) : ?>
							<?php if (count($user_data) == $i) : ?>
								<?php break; ?>
							<?php endif; ?>
							<tr>
								<td><?= $user_data[$i][0]; ?></td>
								<td><?= $user_data[$i][1]; ?></td>
								<td><?= $user_data[$i][2]; ?></td>
								<td><?= $user_data[$i][3]; ?></td>
								<td>
									<form method="post" action="index.php">
										<input type="hidden" name="delete_subscriber" value="<?= $user_data[$i][0] . "," . $user_data[$i][1] . "," . $user_data[$i][2]; ?>">
										<button type="submit" name="delete" class="btn btn-danger delete_subscriber">Ištrinti</button>
										<a href="?user_edit=<?= $user_data[$i][0] . "," . $user_data[$i][1] . "," . $user_data[$i][2]; ?>" class="btn btn-warning">Redaguoti</a>
									</form>
								</td>
							</tr>
						<?php endfor ?>
						</table>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<nav aria-label="Page navigation example">
					  <ul class="pagination justify-content-center">
					  	<?php for ($i=0; $i < (count($user_data) / 5); $i++) : ?>
					  		<?php if ($i == $_SESSION['page']) : ?>
					    		<li class="page-item disabled">
					    			<form method="post" action="index.php">
					    				<input type="hidden" name="page" value="<?= $i; ?>">
					    				<input type="hidden" name="count" value="<?= 5 * $i; ?>">
					    				<button type="submit" class="page-link disabled"><?= $i+1 ?></button>
					    			</form>
					    		</li>
							<?php else : ?>
								<li class="page-item">
									<form method="post" action="index.php">
					    				<input type="hidden" name="page" value="<?= $i; ?>">
					    				<input type="hidden" name="count" value="<?= 5 * $i; ?>">
					    				<button type="submit" class="page-link"><?= $i+1 ?></button>
					    			</form>
								</li>
							<?php endif; ?>
					    <?php endfor; ?>
					  </ul>
					</nav>
				</div>
			</div>
		</div>

		<?php require "partials/scripts.php"; ?>
	</body>
</html>