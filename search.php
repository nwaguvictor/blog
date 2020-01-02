<!-- header -->
<?php include 'partials/header.php' ?>

    <!-- navbar -->
    <?php include 'partials/navbar.php' ?>

<!-- Contents -->
<!-- Search bar -->

<?php 
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $query = "select * from posts where post_tags LIKE '%$search%' ";
        $result = $connection->query($query) or die('Query Failed... '. $connection->error);
        if ($result->num_rows == 0) {
            echo "<h1 class='text-danger'> Search not Found </h1>";
        }
        else {

        ?>

    <div class="container-d-flex p-4">
        <h3>Result From Search</h3>
        <hr />

        <div class="row d-flex">
        <!-- main Content -->
            <div class="col-md-8 p-2">

            <!-- Post section -->
                <section class="p-2 ">
                <!-- Embeded Php -->
                    <?php 
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="first-post">
                            <h1><a href="?post=<?php echo $row['post_id'] ?>"> <?php echo $row['post_title'] ?> </a></h1>
                            <h5>
                                <i class="fa fa-clock-o"></i>
                                <?php echo $row['post_date'] ?>
                                <i class="fa fa-user fa-fw"></i>
                                <a href="#"> <?php echo $row['post_author'] ?> </a>                                
                            </h5> <br>
                            <div class=" mb-3 text-center">
                                <a href="?post=<?php echo $row['post_id'] ?>"><img class="img-fluid" style="width=100%; height:auto" src="images/<?php echo $row['post_image'] ?>" alt="post_image"></a>
                            </div>
                            <p> 
                                <?php echo $row['post_content'] ?> 
                            </p>

                            <div class="read-more">
                                <button type="button" class="btn btn-primary">Read more<i class="fa fa-angle-double-right fa-fw"></i></button>
                            </div>
                            <hr />
                    </div>


                    <?php    } ?>                     
                </section>
            </div>
    <?php    }
        
    }
?>

        <!-- Side bar -->
            <?php include 'partials/sidebar.php' ?>
        <!-- /Sidebar -->
        </div>
    </div>
<!-- Footer -->
<?php include 'partials/footer.php' ?>
