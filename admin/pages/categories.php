<h1 class="text-center">You're On the Categories Page</h1> <hr/>
<div class="cat-list col-md-8 mx-auto">
<!-- Script for creating categories -->
    <?php 
        if (isset($_POST['add_cat'])) {
            $cat_title = $_POST['cat_title'];
            if (($cat_title != '') || (!empty($cat_title))) {
                $sql = "insert into categories(cat_title) values('$cat_title')";
                $cat_query = $connection->query($sql);
            } else {
                echo '<h5 class="text-danger">Field Can\'t be empty!</h5>';
            }
            
        }
    ?>

<!-- Form creating Categories -->
        <div class="row mb-4">
        <form action="" method="post" class='col-md-6'>
            <div class="input-group">
                <input type="text" name="cat_title" class="form-control form-control-sm" placeholder="Enter Category Title">
                <span class="input-group-append">
                    <button type="submit" name="add_cat" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i></button>
                </span>
            </div>
        </form>

<!-- Updating a category form -->

<?php 
    if (isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];
    
        $sql = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $result = $connection->query($sql);
        if ($result->num_rows != 1) {
            echo 'No record found';
        } else {
        $row = $result->fetch_array();
?>
     
            <form action="" method="post" class="col-md-6">
                <div class="input-group">
                    <input type="""text" name="cat_title" value="<?php echo $row['cat_title'] ?>" class="form-control form-control-sm">
                    <span class="input-group-append">
                        <button type="submit" name="update" class="btn btn-info btn-sm">Update</button>
                    </span>
                </div> 
            </form>
    

    <?php    }
    }
?>

<!-- Updating Category Script -->
<?php 
    if (isset($_POST['update'])) {
        $new_title = $_POST['cat_title'];
        $sql = "UPDATE categories SET cat_title = '$new_title' WHERE cat_id = $cat_id";
        $query = $connection->query($sql);
        header('Location:?pages=categories');
    }

?>
</div>


<!--Table for reading Categories -->
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Title</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $sql = 'select * from categories order by cat_id desc';
                    $cat_query = $connection->query($sql);

                    if ($cat_query->num_rows > 0) {
                        while ($cat = $cat_query->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $cat['cat_id'] ?></td>
                            <td><?php echo $cat['cat_title'] ?></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="?pages=categories&cat_id=<?php echo $cat['cat_id'] ?>"><i class="fa fa-edit fa-fw"></i></a>
                                <a onClick="javascript: return confirm('Are you sure?')" class="btn btn-danger btn-sm" href='?pages=categories&delete=<?php echo $cat['cat_id'] ?>'><i class="fa fa-minus fa-fw"></i></a>
                            </td>
                        </tr>

                    <?php    }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Category -->
<?php 
    if (isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];
        $sql = "delete from categories where cat_id = $del_cat_id";
        $query = $connection->query($sql);
        header('Location:?pages=categories');
    }
?>
