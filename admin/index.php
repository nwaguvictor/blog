<?php include 'admin_partials/header.php' ?>

<?php 
	if (isset($_SESSION['username'])) {
      if ($_SESSION['role'] !== 'admin'){
        header("location:../index.php");
		    exit();
      }
  	}
?>

<div class="wrapper">

  <!-- Navbar -->
  <?php include 'admin_partials/top-navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include 'admin_partials/main-sidebar.php' ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
        <?php  
            if (isset($_GET['pages'])) {
                $pages = $_GET['pages'];
                switch ($pages) {
                    case 'categories' :
                      include 'pages/categories.php';
                      break;

                    case 'users' :
                      include 'pages/users.php';
                      break;

                    case 'comments' :
                      include 'pages/comments.php';
                      break;

                      case 'posts' :
                      include 'pages/posts.php';
                      break;

                      case 'profile' :
                      include 'pages/profile.php';
                      break;

                      case 'add_post' :
                        include 'pages/add_post.php';
                        break;

                      case 'edit_post' :
                        include 'pages/edit_post.php';
                        break;

                      case 'view_user' :
                        include 'pages/view_user.php';
                        break;
                      
                      case 'edit_user' :
                        include 'pages/edit_user.php';
                        break;
                        
                    default :
                      require 'pages/dashboard.php';
                }

			}else {
        require "pages/dashboard.php";
      }
			
        
        ?>
        
    </div>
    </div> <!-- /Main content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  


<!-- Footer and scripts -->
<?php include 'admin_partials/footer.php' ?>

