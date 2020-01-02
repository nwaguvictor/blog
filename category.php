<!-- header -->
<?php include 'partials/header.php' ?>

    <!-- navbar -->
    <?php include 'partials/navbar.php' ?>

<!-- Contents -->
    <div class="container-d-flex p-4">

        <div class="row d-flex">
        <!-- main Content -->
            <div class="col-md-8 p-2">
            <a href="index.php"><i class="fa fa-arrow-left fa-fw"></i>Home</a>

            <!-- Post section -->
                <section class="p-2 ">
                <!-- Embeded Php -->
                    <?php 
                        if (isset($_GET['cat_id'])) {
                            $the_cat_id = $_GET['cat_id'];
                        

                            $sql = "select * from posts where post_cat_id = $the_cat_id";
                            $query = $connection->query($sql);

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                    ?>
                    <div class="first-post">
                            <h1><a href="post.php?post_id=<?php echo $row['post_id'] ?>"> <?php echo $row['post_title'] ?> </a></h1>
                            <h5>
                                <i class="fa fa-clock-o"></i>
                                <?php echo $row['post_date'] ?>
                                <i class="fa fa-user fa-fw"></i>
                                <a href="#"> <?php echo $row['post_author'] ?> </a>                                
                            </h5> <br>
                            <div class=" mb-3 text-center">
                            <!-- Post Image -->
                                <a href="post.php?post_id=<?php echo $row['post_id'] ?>"><img class="img-fluid" style="width=100%; height:400px" src="images/<?php echo $row['post_image'] ?>" alt="post_image"></a>
                            </div>
                            <p> 
                                <?php echo substr($row['post_content'], 0, 200); ?> 
                            </p>

                            <div class="read-more">
                                <a href="post.php?post_id=<?php echo $row['post_id'] ?>" class="btn btn-primary">Read more
                                    <i class="fa fa-angle-double-right fa-fw"></i>
                                </a>
                            </div>
                            <hr />
                    </div>

                    <?php    }
                        } else {
                            echo '<h5 class="text-center text-danger">No Posts for this Category</h5>';
                        }
                    }
                        
                        ?>                     
                </section>
            </div>

        <!-- Side bar -->
            <?php include 'partials/sidebar.php' ?>
        <!-- /Sidebar -->
        </div>
    </div>


<!-- Footer -->
<?php include 'partials/footer.php' ?>
