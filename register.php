<!-- header -->
<?php include 'partials/header.php' ?>

    <!-- navbar -->
    <?php include 'partials/navbar.php' ?>

<!-- Contents -->
    <div class="container-d-flex p-4">
        <h1>Register a User</h1>
        <hr />

        <div class="row d-flex">
        <!-- main Content -->
            <div class="col-md-8 p-2">

            <!-- create user section -->
                <section class="p-2">
                    
                        <form action="" method="post" class="p-4 shadow" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" name="firstname" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" name="lastname" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group d-flex flex-column">
                                    <label for="profile">Profile:</label>
                                    <input type="file" name="profile">
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                <button type="submit" name="register" class="btn btn-success form-control">
                               <i class="fa fa-sign-in fa-fw"></i> Sign Up</button>
                            </div>
                        </form>
                                     
                </section>
            </div>

            <!-- Register Script -->

            <?php 
                function check_user($data) {
                    $data = trim($data);
                    $data = stripcslashes($data);
                    $data = htmlspecialchars($data);

                    return $data;
                }

                if (isset($_POST['register'])) {
                    $first      = check_user($_POST['firstname']);
                    $last       = check_user($_POST['lastname']);
                    $email      = check_user($_POST['email']);
                    $username   = check_user($_POST['username']);
                    $pass       = check_user($_POST['password']);
                    $image      = $_FILES['profile']['name'];
                    $temp_image = $_FILES['profile']['tmp_name'];

                    move_uploaded_file($temp_image, "images/$image");
                

                    $sql = "insert into users(username, first_name, last_name, email, password, user_image, role) 
                            values('$username', '$first', '$last', '$email', '$pass', '$image', 'subscriber')";
                    $query = $connection->query($sql) or die("Failed... ".$connection->error);
                    header("location:index.php");
                    

                }
            ?>

        <!-- Side bar -->
            <?php include 'partials/sidebar.php' ?>
        <!-- /Sidebar -->
        </div>
    </div>


<!-- Footer -->
<?php include 'partials/footer.php' ?>
