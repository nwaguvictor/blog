<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-danger">
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="index.php" class="d-block">
						<?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : 'GuestUser') ?></a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
					<li class="nav-item">
						<a href="?pages" class="nav-link active">
							<i class="nav-icon fa fa-tachometer"></i>
							<p> Dashboard </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="?pages=posts" class="nav-link">
							<i class="nav-icon fa fa-file"></i>
							<p> Posts </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="?pages=users" class="nav-link">
							<i class="nav-icon fa fa-users"></i>
							<p> Users </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="?pages=categories" class="nav-link">
							<i class="nav-icon fa fa-list"></i>
							<p> Categories </p>
						</a>
					</li>

					<li class="nav-item">
						<a href="?pages=comments" class="nav-link">
							<i class="nav-icon fa fa-comment"></i>
							<p> Comments </p>
						</a>
					</li>

					<?php 
						if (isset($_SESSION['username'])) {
							$username = $_SESSION['username'];
							$sql = "select * from users where username = '$username'";
							$query = $connection->query($sql) or die('Error occured... '.$connection->error);
							while ($row = $query->fetch_assoc()) {
								$user_id = $row['user_id'];
							}
						}	
					?>

					<li class="nav-item">
						<a href="?pages=profile&profile_id=<?php echo $user_id ?>" class="nav-link">
							<i class="nav-icon fa fa-user"></i>
							<p> Profile </p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>