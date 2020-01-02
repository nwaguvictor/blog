<!-- Adding a Post -->

<div class="container p-3">
<h3 class="border-bottom mb-3 pb-2 text-center">Adding A Post</h3>
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
                            value="<?php echo isset($_POST['post_title']) ? $_POST['post_title'] : '' ?>" >
                    </div>

                    <div class="form-group">
                        <label for="post_status">Post Status:</label>
                        <select name="post_status" class="form-control form-control-sm" id="" required="required">
                            <option value="published">Publish</option>
                            <option value="draft" selected>Draft</option>
                        </select>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="image">Post Image:</label>
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
                            value="<?php echo isset($_POST['author']) ? $_POST['author'] : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags:</label>
                        <input 
                            type="text" 
                            name="post_tags" 
                            placeholder="Enter post tags" 
                            class="form-control form-control-sm"
                            required="required"
                            value="<?php echo isset($_POST['post_tags']) ? $_POST['post_tags'] : '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_category">Post Category:</label>
                        <select name="post_category" class="form-control form-control-sm" id="" required="required">
                            <option value="" selected>Select Category</option>
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
                    ><?php echo isset($_POST['post_content']) ? $_POST['post_content'] : '' ?></textarea>
            </div>

                <div class="form-group">
                    <button 
                        class="btn btn-success form-control" 
                        type="submit" name="add_post">
                        <i class="fa fa-plus fa-fw"></i>
                        Add Post
                    </button>
                </div>
         
        </form>
    </div>
</div>

<!-- Adding post script -->

<?php 
    if (isset($_POST['add_post'])) {
        $post_title     = test_input($_POST['post_title']);
        $author         = test_input($_POST['author']);
        $post_date      = date('d-m-y');
        $post_category  = $_POST['post_category'];
        $post_status    = $_POST['post_status'];
        $post_tags      = test_input($_POST['post_tags']);
        $post_content   = test_input($_POST['post_content']);
        $post_image     = $_FILES['post_image']['name'];
        $temp_post_image     = $_FILES['post_image']['tmp_name'];

        if (($author == '') || (empty($author))) {
            $author = 'Anonymous';
        }

        move_uploaded_file($temp_post_image, "../images/$post_image");
        

        $insert_sql = "insert into posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) 
                    values($post_category, '$post_title','$author',now(), '$post_image','$post_content','$post_tags', '$post_status')";
        $insert_query = $connection->query($insert_sql) or die('Query Failed..'.$connection->error);
        header("Location:?pages=posts");
        exit();
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>