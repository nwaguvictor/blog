<div class="container">
<!-- View A user -->
    <?php 
        if (isset($_GET['user_id'])) {
            $user_id =  $_GET['user_id'];

            $sql = "select * from users where user_id = $user_id";
            $query = $connection->query($sql) or die("Failed to load... ".$connection->error);
            if ($query->num_rows > 0) {
                while ($user = $query->fetch_assoc()) {
    ?>
        <h1 class="border-bottom pb-2 text-center">Profile of <?php echo $user['username'] ?></h1>
            <a class="btn btn-info mb-2" href="?pages=edit_user&editUser=<?php echo $user_id ?>">Edit</a>
            <a onClick="javascript: return confirm('Delete User?')" class="btn btn-danger mb-2 pull-right" href="?pages=users&deleteUser_id=<?php echo $user_id ?>">Delete</a>
        <div class="row">
        
            <div class="col-md-4">
                <img class="img-fluid img-thumbnail" src="../images/<?php echo $user['user_image']; ?>" alt="">
            </div>

            <div class="col-md-8 rounded border p-3">
                <h5 class="">First Name: <strong><?php echo strtoupper($user['first_name']) ?></strong></h5>
                <h5 class="">Last Name: <strong><?php echo strtoupper($user['last_name']) ?></strong></h5>
                <h5 class="">Username: <strong><?php echo $user['username'] ?></strong></h5>
                <h5 class="">E-mail: <strong><?php echo $user['email'] ?></strong></h5>
                <h5 class="">User Role: <strong><?php echo strtoupper($user['role']) ?></strong></h5>
            </div>
        </div>

    <?php       }
            }
        }
    
    ?>
</div>

<!-- delete query -->

<?php 
    if (isset($_GET['deleteUser_id'])) {
        echo $_GET['deleteUser_id'];
    }
?>