<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Metasite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
      	<?php if (isset($_SESSION['name'])) : ?>
	        <li class="nav-item active">
	          <a class="btn btn-outline-light" href="index.php?logout">Atsijungti</a>
	        </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="btn btn-outline-primary m-1" href="index.php?register">Registracija</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-success m-1" href="index.php?login">Prisijungti</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header>