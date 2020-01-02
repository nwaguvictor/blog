<div class="col-md-4 p-2">
    <aside class="p-2 bg-light rounded mb-4">
        <div class="search-bar p-4">
        <h4>Search:</h4>
        <form action="search.php" method="post" role="form" id="search">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Look Up...">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search fa-fw"></i></button>
                </div>
            </div>
        </form>
        </div>
    </aside>

    <aside class="p-2 bg-light rounded mb-4">
        <div class="categories p-4">
        <h3>Blog Categories</h3>
        <hr/>
            <?php  
                $sql = "select * from categories";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    while ($cat = $result->fetch_array()) {
                ?>
                <ul class="list-unstyled">
                    <li class=''><a href="category.php?cat_id=<?php echo $cat['cat_id'] ?>"> <i class="fa fa-angle-double-right fa-fw"></i> <?php echo $cat['cat_title']; ?></a></li>
                </ul>



                <?php    }
                }
            ?>
        </div>
    </aside>

    <aside class="p-2 bg-light rounded mb-4">
        <div class="login p-4">
        <h3>Login:</h3>
        <h5 class="text-danger" id="message"></h5>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter username" class="form-control">
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="***************" class="form-control">
                </div>


                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary form-control">
                    <i class="fa fa-sign-in fa-fw"></i>Sign In</button>
                </div>

                <div class="form-group">
                    <a href="">Forgot password? </a><a href="register.php" class="pull-right">Register here </a>
                </div>
                
            </form>
        </div>
    </aside>
</div>

<?php 


    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = $connection->real_escape_string($username);
        $password = $connection->real_escape_string($password);

        $sql = "select * from users where username = '$username' and password = '$password' ";
        $query = $connection->query($sql) or die('Failed... '.$connection->error);
        if ($query->num_rows == 1) {
            while ($user_row = $query->fetch_assoc()) {
                $db_user = $user_row['username'];
                $db_pass = $user_row['password'];
                $user_role = $user_row['role'];
            }


            if (($username == $db_user) && ($password == $db_pass) && ($user_role == 'admin')) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user_role;
                header('Location: admin?pages');
                exit();

            } else if (($username == $db_user) && ($password == $db_pass) && ($user_role != 'admin')) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user_role;
                header('Location: index.php');
                exit();
            }

        } else {
            echo '<script>
                    document.getElementById("message").innerHTML = "No User found";
                </script>';
        }


    }
?>

