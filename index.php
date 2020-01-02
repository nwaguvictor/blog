<!-- header -->
<?php include 'partials/header.php' ?>

    <!-- navbar -->
    <?php include 'partials/navbar.php' ?>

<!-- Contents -->
    <div class="container-d-flex p-4">
        <h1>News Update</h1>
        <hr />

        <div class="row d-flex">
        <!-- main Content -->
            <div class="col-md-8 p-2">

            <!-- Post section -->
                <section class="p-2 ">
                <!-- Embeded Php -->
                    <?php 
                        $sql = "select * from posts order by post_id desc ";
                        $query = $connection->query($sql);

                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                                $post_status = $row['post_status'];

                                if ($post_status !== 'published') {
                                    echo '<h2 class="text-danger text-center">You have not Published any post !!!</h2>';        
                                } else {

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
                        } } ?>                     
                </section>
            </div>

        <!-- Side bar -->
            <?php include 'partials/sidebar.php' ?>
        <!-- /Sidebar -->
        </div>
    </div>


<!-- Footer -->
<?php include 'partials/footer.php' ?>
