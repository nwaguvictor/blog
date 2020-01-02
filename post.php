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
                        if (isset($_GET['post_id'])) {
                            $the_post_id = $_GET['post_id'];
                        

                            $sql = "select * from posts where post_id = $the_post_id";
                            $query = $connection->query($sql);

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    $post_content = $row['post_content'];
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
                                <a href="post.php?post_id=<?php echo $row['post_id'] ?>">
                                <img class="img-fluid" style="width=100%; height:400px" 
                                src="images/<?php echo $row['post_image'] ?>" alt="post_image"></a>
                            </div>
                            <div> 
                                <?php echo $post_content ?> 
                            </div>
                    </div>





                    <!-- Comment section -->
                    <!-- Reading comments -->
                    <div class="col-md-10 mt-5 shadow p-4 mx-auto">
                        <h5 class="border-bottom pb-1 text-info">Comments:</h5>
                <?php 
                    $select_sql = "select * from comments where comment_status = 'Approved'
                                     and comment_post_id = $the_post_id order by comment_id desc";
                    $select_query = $connection->query($select_sql) or die('failed...' .$connection->error);
                    if ($select_query->num_rows > 0) {
                        while ($row = $select_query->fetch_assoc()) {
                ?>
                        <div class="px-5 py-2">
                            <h6 class="border-bottom pb-1">
                                <i class="fa fa-user fa-fw"></i><?php echo $row['comment_author'] ?>
                                <i class="fa fa-calendar fa-fw"></i><?php echo $row['comment_date'] ?>
                            </h6>
                            <p class="justify-content-center px-4">
                                <?php echo $row['comment_content'] ?>
                            </p>
                        </div>

                <?php   }
                    }
                ?>
                        
                    </div>



                    <!-- Creating Comments -->
                    <div class="mt-5 col-md-8 p-4 rounded shadow mx-auto">
                    <h5 class="border-bottom pb-2 mb-3">Leave A comment</h5>
                        <div class="form p-3">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Your name:</label>
                                    <input type="text" 
                                        name="name" 
                                        class="form-control form-control-sm"
                                        required="required" 
                                        placeholder="Enter your name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Your E-mail:</label>
                                    <input type="email" 
                                        name="email" 
                                        class="form-control form-control-sm"
                                        required="required" 
                                        placeholder="Enter your E-mail">
                                </div>

                                <div class="form-group">
                                    <label for="message">Your Message:</label>
                                    <textarea name="message" 
                                    id="" cols="30" rows="7" 
                                    class="form-control form-control-sm"
                                    required="required"
                                    placeholder="Type your comments here..."></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" 
                                        name="send" 
                                        class="form-control btn btn-primary" 
                                        value="Send">
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php 
                        function check_data($data) {
                            $data = trim($data);
                            $data = stripcslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }


                        if (isset($_POST['send'])) {
                            if (!isset($_SESSION['username'])) {
                                echo '
                                    <script>
                                        alert("Please Login!");
                                    </script>
                                ';
                            }else {
                                $name = check_data($_POST['name']);
                                $email = check_data($_POST['email']);
                                $message = check_data($_POST['message']);

                                $comment_insert_sql = "insert into comments(comment_post_id, comment_author, 
                                        author_email, comment_content, comment_status, comment_date) 
                                        values($the_post_id, '$name', '$email', '$message', 'Unapproved', now() )";
                                $comment_query = $connection->query($comment_insert_sql) or die('Error... '.$connection->error);
                            }
                        }
                    
                    ?>













                    <?php    }
                        } }?>                     
                </section>
            </div>

        <!-- Side bar -->
            <?php include 'partials/sidebar.php' ?>
        <!-- /Sidebar -->
        </div>
    </div>


<!-- Footer -->
<?php include 'partials/footer.php' ?>
