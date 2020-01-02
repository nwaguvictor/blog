<h1 class="text-center">You're On the Comments Page</h1> <hr/>
<div class="container">
    <div class="col-md-12 mx-auto">
        <div class="table-responsive">
        <!-- Read All the Posts -->
            <table class="table table-bordered table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Content</th>
                        <th>Response To</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $sql = "select * from comments order by comment_id desc";
                        $query = $connection->query($sql) or die('Query Failed... '.$connection->error);
                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                                $comment_id = $row['comment_id'];
                                $com_post_id = $row['comment_post_id'];
                    ?>
                        <tr>
                            <td><?php echo $row['comment_id']; ?></td>
                            <td><?php echo $row['comment_author']; ?></td>
                            <td><?php echo $row['author_email']; ?></td>
                            <td><?php echo substr($row['comment_content'], 0, 20); ?></td>
                        <?php 
                            $select_sql = "select * from posts where post_id = $com_post_id";
                            $select_query = $connection->query($select_sql) or die('Error... '.$connection->error );
                            $post_row = $select_query->fetch_assoc();
                        ?>
                            <td>
                                <a href="../post.php?post_id=<?php echo $post_row['post_id'] ?>">
                                <?php echo substr($post_row['post_title'], 0, 50); ?></a>
                            </td>
                            <td><?php echo $row['comment_date']; ?></td>
                            <td><?php echo $row['comment_status']; ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="?pages=comments&unapprove_id=<?php echo $comment_id ?>">
                                    <i class="fa fa-ban fa-fw"></i>
                                </a>

                                <a class="btn btn-success btn-sm" href="?pages=comments&approve_id=<?php echo $comment_id ?>">
                                    <i class="fa fa-check fa-fw"></i>
                                </a>

                                <a onClick="javascript: return confirm('Delete Comment?')" class="btn btn-danger btn-sm" href="?pages=comments&com_id=<?php echo $comment_id ?>">
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

<!-- Delete and Update comment Script -->

<?php
    if (isset($_GET['com_id'])) {
        $com_id = $_GET['com_id'];

        $delete_sql = "delete from comments where comment_id = $com_id";
        $query = $connection->query($delete_sql) or die("Failed...".$connection->error);
        header("Location:?pages=comments");
        exit();
    }

    if (isset($_GET['approve_id'])) {
        $approve_id = $_GET['approve_id'];

        $approve_sql = "update comments set comment_status = 'Approved' where comment_id = $approve_id";
        $query = $connection->query($approve_sql) or die("Failed...".$connection->error);
        header("Location:?pages=comments");
        exit();
    }

    if (isset($_GET['unapprove_id'])) {
        $unapprove_id = $_GET['unapprove_id'];

        $unapprove_sql = "update comments set comment_status = 'Unapproved' where comment_id = $unapprove_id";
        $query = $connection->query($unapprove_sql) or die("Failed...".$connection->error);
        header("Location:?pages=comments");
        exit();
    }
?>