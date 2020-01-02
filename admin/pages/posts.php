<h1 class="text-center">You're On the Posts Page</h1> <hr/>
<div class="container">
    <div class="col-md-12 mx-auto">
    <a class="btn btn-primary btn-sm mb-2 pull-right" href="?pages=add_post"><i class="fa fa-plus fa-fw"></i></a>
        <div class="table-responsive">
        <!-- Read All the Posts -->
            <table class="table table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $sql = "select * from posts order by post_id desc";
                        $query = $connection->query($sql) or die('Query Failed... '.$connection->error);
                        if ($query->num_rows > 0) {
                            while ($post_row = $query->fetch_assoc()) {
                                $cat_id = $post_row['post_cat_id'];
                                $post_id = $post_row['post_id'];
                    ?>
                        <tr>
                            <td><?php echo $post_row['post_id']; ?></td>
                            <td>
                            <!-- Post_image -->
                                <img 
                                    class="img-fluid" 
                                    style="width:50px; height:30px" 
                                    src="../images/<?php echo $post_row['post_image'] ?>" 
                                    alt="post image">
                            </td>
                            <td><?php echo $post_row['post_author']; ?></td>
                            <td>
                                <a href="../post.php?post_id=<?php echo $post_row['post_id'] ?>">
                                    <?php echo $post_row['post_title']; ?></a>
                            </td>
                            <!-- Category -->
                            <?php 
                                $cat_sql = "select * from categories where cat_id = $cat_id";
                                $cat_query = $connection->query($cat_sql) or die('Error occured... '.$connection->error);
                                $cat_details = $cat_query->fetch_assoc();
                            ?>

                            <td><?php echo $cat_details['cat_title']; ?></td>

                            <!-- Comment_Count -->
                            <?php 
                                $com_sql = "select * from comments where comment_post_id = $post_id";
                                $com_query = $connection->query($com_sql) or die('Error Occured...' .$connection->error);
                                $num = $com_query->num_rows;
                                
                            
                            ?>
                            
                            <td><?php echo $num ?></td>
                            <td><?php echo $post_row['post_date'] ?></td>
                            <td><?php echo $post_row['post_status'] ?></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="?pages=edit_post&edit_post_id=<?php echo $post_row['post_id'] ?>">
                                    <i class="fa fa-edit fa-fw"></i>
                                </a>

                                <a onClick="javascript: return confirm('Delete Post?')" class="btn btn-danger btn-sm" href="?pages=posts&delete_post=<?php echo $post_row['post_id'] ?>">
                                    <i class="fa fa-minus fa-fw"></i>
                                </a>
                            </td>
                        </tr>

                        <?php    }

                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Post Script -->

<?php
    if (isset($_GET['delete_post'])) {
        $post_id = $_GET['delete_post'];

        $query = $connection->query("delete from posts where post_id = $post_id") or die("Failed...".$connection->error);

        $delete_com = "delete from comments where comment_post_id = $post_id";
        $com_query = $connection->query($delete_com) or die("Query failed... ".$connection->error);
        header("Location:?pages=posts");
        exit();
    }
?>