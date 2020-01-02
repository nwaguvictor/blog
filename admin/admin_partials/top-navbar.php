<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
			</li>
			<li class="nav-item d-sm-inline-block">
				<a href="../index.php" class="nav-link">Home</a>
			</li>
		</ul>

		<!-- Right navbar links -->
		
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="btn btn-danger text-white" href="?logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" href="#"><i class="fa fa-th-large"></i></a>
			</li>

			
		</ul>
	</nav>

	<?php 
		if (isset($_GET['logout'])) {
			if ($_SESSION['role'] == 'admin') {
				session_unset();
				session_destroy();
				header("location: ../index.php");
			}
		}
	?>