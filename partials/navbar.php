<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Simple Blog</a>
    <button type="button" class="navbar-toggler" data-target="#menuList" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuList">
    <ul class="navbar-nav">
        <?php 
            $sql = 'select * from categories limit 3';
            $query = $connection->query($sql);

            while($row = $query->fetch_assoc()){
        ?>
            <li class="nav-item"><a class="nav-link" href="category.php?cat_id=<?php echo $row['cat_id'] ?>"><?php echo $row['cat_title'] ?></a></li>

        <?php } ?>
        <!-- <li class="nav-item"><a class="nav-link" href="admin?pages">Admin</a></li> -->
        
    </ul>

    <ul class="navbar-nav ml-auto">
        <?php 
            if (isset($_SESSION['username'])) {
                if ($_SESSION['role'] !== 'admin') {
                    $user_role = $_SESSION['role'];
                    echo '<li class="nav-item"><a href="" class="nav-link">'.$user_role.'</a></li>';
    
                }else {
                    echo '<li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>';
                    
                }

            echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';

            }
        ?>
    </ul>


    </div>
</nav>