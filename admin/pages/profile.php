<?php 
    if (isset($_GET['profile_id'])) {
        $user_id = $_GET['profile_id'];

        $sql = "select * from users where user_id = $user_id";
        $query = $connection->query($sql) or die("Failed to load... ".$connection->error);
        while ($user = $query->fetch_assoc()) {
?>

        <h1 class="border-bottom pb-2 text-center">Your Profile</h1>
        <div class="row">
        
            <div class="col-md-4">
                <img class="img-fluid img-thumbnail" src="../images/<?php echo $user['user_image']; ?>" alt="">
            </div>

            <div class="col-md-8 rounded border p-3">
                <h5 class="border-bottom">First Name: <strong><?php echo strtoupper($user['first_name']) ?></strong></h5>
                <h5 class="border-bottom">Last Name: <strong><?php echo strtoupper($user['last_name']) ?></strong></h5>
                <h5 class="border-bottom">Username: <strong><?php echo $user['username'] ?></strong></h5>
                <h5 class="border-bottom">E-mail: <strong><?php echo $user['email'] ?></strong></h5>
                <h5 class="border-bottom">User Role: <strong><?php echo strtoupper($user['role']) ?></strong></h5>
            </div>
        </div>
<?php   }
   }

?>