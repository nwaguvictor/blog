<div class="row d-flex">
        <!-- main Content -->
            <div class="col-md-8 p-2 mx-auto">
            <?php 
                if (isset($_GET['editUser'])) {
                    $user_id = $_GET['editUser'];

                    $sql = "select * from users where user_id = $user_id";
                    $query = $connection->query($sql) or die('Failed... '.$connection->error);
                    while ($user_row = $query->fetch_assoc()) {
            ?>

            

            <!-- update user section -->
            <h3>Editing <?php echo $user_row['username'] ?></h3>
                <section class="p-2">
                    
                        <form action="" method="post" class="p-4 shadow" enctype="multipart/form-data">
                        <div class="mb-3">
                            <img class="img-fluid" src="../images/<?php echo $user_row['user_image'] ?>" alt="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" 
                                        name="firstname" 
                                        class="form-control"
                                        value="<?php echo (isset($_POST['firstname']) ? $_POST['firstname'] : $user_row['first_name'] ) ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" 
                                        name="lastname" 
                                        class="form-control"
                                        value="<?php echo (isset($_POST['lastname']) ? $_POST['lastname'] : $user_row['last_name'] ) ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" 
                                        name="email" 
                                        class="form-control"
                                        value="<?php echo (isset($_POST['email']) ? $_POST['email'] : $user_row['email'] ) ?>"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" 
                                        name="username" 
                                        class="form-control"
                                        value="<?php echo (isset($_POST['username']) ? $_POST['username'] : $user_row['username'] ) ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" 
                                        name="password" 
                                        class="form-control"
                                        value="<?php echo (isset($_POST['password']) ? $_POST['password'] : $user_row['password'] ) ?>" 
                                        required>
                                </div>

                                <div class="form-group d-flex flex-column">
                                    <label for="profile">Profile:</label>
                                    <input type="file" name="profile">
                                </div>
                            </div>
                        </div>

                            <div class="form-group">
                                <select name="role" id="" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="subscriber" selected>Subscriber</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="update" class="btn btn-success form-control">
                               <i class="fa fa-sign-in fa-fw"></i> Update User</button>
                            </div>
                        </form>
                                     
                </section>
            <?php   }
                }
            ?>
            </div>

            <!-- Register Script -->

            <?php 
                function check_user($data) {
                    $data = trim($data);
                    $data = stripcslashes($data);
                    $data = htmlspecialchars($data);

                    return $data;
                }

                if (isset($_POST['update'])) {
                    $first      = check_user($_POST['firstname']);
                    $last       = check_user($_POST['lastname']);
                    $email      = check_user($_POST['email']);
                    $username   = check_user($_POST['username']);
                    $pass       = check_user($_POST['password']);
                    $image      = $_FILES['profile']['name'];
                    $temp_image = $_FILES['profile']['tmp_name'];
                    $role       = $_POST['role'];
                    
                    if (empty($image)) {
                        $get = "select * from users where user_id = $user_id";
                        $query = $connection->query($get) or die('Failed...' .$connection->error);
                        $row = $query->fetch_assoc();

                        $image = $row['user_image'];
                    } 
                    move_uploaded_file($temp_image, "../images/$image");
                

                    $sql = "update users set username = '$username', first_name = '$first', last_name = '$last',
                            email = '$email', password = '$pass', user_image = '$image', role = '$role' 
                            where user_id = $user_id";
                    $query_table = $connection->query($sql) or die('Failed... '.$connection->error);
                    header("Location:?pages=users");
                    

                }
            ?>
        </div>