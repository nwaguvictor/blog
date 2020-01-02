<!-- Editing A Post -->
<?php 
    if (isset($_GET['edit_post_id'])) {
        $edit_post_id = $_GET['edit_post_id'];

        $select_sql = "select * from posts where post_id = $edit_post_id";
        $select_query = $connection->query($select_sql) or die('Failed to update... '.$connection->error);
        $records = $select_query->fetch_assoc();
        $post_cat_id = $records['post_cat_id'];
    }
?>

<div class="container p-3">
<h3 class="border-bottom mb-3 pb-2 text-center">Edit A Post</h3>
    <div class="col-md-8 mx-auto">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                <!-- left side form -->
                    <div class="form-group">
                        <label for="post_title">Title:</label>
                        <input 
                            type="text" 
                            name="post_title" 
                            placeholder="Enter post Title" 
                            class="form-control form-control-sm"
                            required="required"
                            value="<?php echo isset($_POST['post_title']) ? $_POST['post_title'] : $records['post_title'] ?>" >
                    </div>

                    <div class="form-group">
                        <label for="post_status">Post Status:</label>
                        <select name="post_status" class="form-control form-control-sm" id="" required="required">
                            <option value="<?php echo $records['post_status'] ?>" selected>
                                <?php echo $records['post_status'] == 'published' ? 'Publish' : 'Draft' ?>
                            </option>
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="image">Post Image:</label>
                        <img src="../images/<?php echo $records['post_image']; ?>" alt="" 
                            class="img-fluid img-rounded mb-2" style="width:100px; height:60px">
                        <input type="file" name="post_image">
                    </div>
                    
                </div>

                <div class="col-md-6">
                <!-- right side form -->

                    <div class="form-group">
                        <label for="author">Post Author:</label>
                        <input 
                            type="text" 
                            name="author" 
                            placeholder="Enter post author" 
                            class="form-control form-control-sm"
                            value="<?php echo isset($_POST['author']) ? $_POST['author'] : $records['post_author'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags:</label>
                        <input 
                            type="text" 
                            name="post_tags" 
                            placeholder="Enter post tags" 
                            class="form-control form-control-sm"
                            required="required"
                            value="<?php echo isset($_POST['post_tags']) ? $_POST['post_tags'] : $records['post_tags'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_category">Post Category:</label>
                        <select name="post_category" class="form-control form-control-sm" id="" required="required">
                            <?php 
                                $sql = "select * from categories where cat_id = $post_cat_id";
                                $query = $connection->query($sql);
                                $row = $query->fetch_assoc();
                            
                            ?>
                            <option value="<?php echo $row['cat_id'] ?>" selected><?php echo $row['cat_title'] ?></option>

                            <?php 
                                $query = $connection->query("select * from categories") or die('Failed. '.$connection->error);
                                while ($cat_row = $query->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $cat_row['cat_id']; ?>" ><?php echo $cat_row['cat_title']; ?></option>
                            <?php   }
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="post_content">Post Content:</label>
                <textarea 
                    name="post_content" 
                    id="" 
                    cols="30" 
                    class="form-control form-control-sm" 
                    rows="10"
                    required="required" 
                    placeholder="Type your post here..." 
                    ><?php echo isset($_POST['post_content']) ? $_POST['post_content'] : $records['post_content'] ?></textarea>
            </div>

                <div class="form-group">
                    <button 
                        class="btn btn-success form-control" 
                        type="submit" name="update_post">
                        <i class="fa fa-edit fa-fw"></i>
                        Update Post
                    </button>
                </div>
         
        </form>
    </div>
</div>

<!-- Updating Script -->
<?php 
    if (isset($_POST['update_post'])) {
        $post_title     = check_data($_POST['post_title']);
        $post_author    = check_data($_POST['author']);
        $post_status    = $_POST['post_status'];
        $post_tags      = check_data($_POST['post_tags']);
        $post_category  = $_POST['post_category'];
        $post_content   = check_data($_POST['post_content']);
        $post_image     = $_FILES['post_image']['name'];
        $tmp_post_image = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($tmp_post_image, "../images/$post_image");

        if (($post_author == "") || (empty($post_author))) {
            $post_author = 'Anonymous';
        }

        if (empty($post_image)) {
            $sql    = "select * from posts where post_id = $edit_post_id";
            $query  = $connection->query($sql) or die('Failed Query... '.$connection->error);
            $row    = $query->fetch_assoc();

            $post_image = $row['post_image'];
        }

        // Retrieving the old image if new one is not selected
        $update_sql = "UPDATE posts SET post_cat_id = $post_category, 
                        post_title = '$post_title', post_author = '$post_author', post_date = now(), 
                        post_image = '$post_image', post_content = '$post_content', post_tags = '$post_tags',
                        post_status = '$post_status' WHERE post_id = $edit_post_id";

        $update_query = $connection->query($update_sql) or die('Update Query Failed...'.$connection->error);
        header("Location:?pages=posts");

    }


    function check_data($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>