<h1 class="text-center">You're On the Users Page</h1> <hr/>
<div class="container">
    <div class="col-md-9 mx-auto">
        <div class="table-responsive">
        <!-- Read All the Posts -->
            <table class="table table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>E-mail</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                    $query = $connection->query($sql = "select * from users order by user_id desc") or die("Failed... ".$connection->error);
                    if ($query->num_rows > 0) {
                        while ($user = $query->fetch_assoc()) {
                            $user_id    = $user['user_id'];
                ?>
                    <tr>
                        <td><?php echo $user_id ?></td>
                        <td><img class="img-fluid" style="width:60px" src="../images/<?php echo $user['user_image'] ?>" alt=""></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['role'] ?></td>
                        <td>
                            <a class="btn btn-success btn-sm" href="?pages=view_user&user_id=<?php echo $user_id ?>">
                                View User
                            </a>
                        </td>
                    </tr>

                <?php   }
                    }
                
                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete User Script -->

<?php
    if (isset($_GET['deleteUser_id'])) {
        $user_id = $_GET['deleteUser_id'];

        $delete_sql = "delete from users where user_id = $user_id";
        $query = $connection->query($delete_sql) or die("Failed...".$connection->error);
        header("Location:?pages=users");
        exit();
    }
?>