<!-- All Queries -->
<?php
// Posts Query 
    $post_query = $connection->query("select * from posts");
    $post_count = $post_query->num_rows;

    //published Posts Query 
    $published_post_query = $connection->query("select * from posts where post_status = 'published'");
    $published_post_count = $published_post_query->num_rows;

    //draft Posts Query 
    $draft_post_query = $connection->query("select * from posts where post_status = 'draft'");
    $draft_post_count = $draft_post_query->num_rows;

// comments Query
    $comment_query = $connection->query("select * from comments");
    $comment_count = $comment_query->num_rows;

    // //approved comments Query
    // $approve_comment_query = $connection->query("select * from comments where comment_status = 'Approved'");
    // $approve_comment_count = $approve_comment_query->num_rows;

    // //unapproved comments Query
    // $unapprove_comment_query = $connection->query("select * from comments where comment_status = 'Unapproved'");
    // $unapprove_comment_count = $unapprove_comment_query->num_rows;

// users Query
    $user_query = $connection->query("select * from users");
    $user_count = $user_query->num_rows;

// categories Query
    $cat_query = $connection->query("select * from categories");
    $cat_count = $cat_query->num_rows;
?>


<div class="container-d-flex p-2">
    <div class="row">
    <!-- Card one -->
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="pull-left">
                        <i class="fa fa-file-text fa-fw fa-4x"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $post_count ?></h1>
                        <h3>Posts</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="pull-left"><a href="?pages=posts" class="stretched-link">View More</a></span>
                    <span class="pull-right"><i class="fa fa-angle-double-right fa-lg"></i></span>
                </div>
            </div>
        </div>

    <!-- Card two -->
    <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card card-danger">
                <div class="card-header">
                    <div class="pull-left">
                        <i class="fa fa-comments fa-fw fa-4x"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $comment_count ?></h1>
                        <h3>Comments</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="pull-left"><a href="?pages=comments" class="stretched-link">View More</a></span>
                    <span class="pull-right"><i class="fa fa-angle-double-right fa-lg"></i></span>
                </div>
            </div>
        </div>

        <!-- Card Three -->
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card card-success">
                <div class="card-header">
                    <div class="pull-left">
                        <i class="fa fa-users fa-fw fa-4x"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $user_count ?></h1>
                        <h3>Users</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="pull-left"><a href="?pages=users" class="stretched-link">View More</a></span>
                    <span class="pull-right"><i class="fa fa-angle-double-right fa-lg"></i></span>
                </div>
            </div>
        </div>

    <!-- Card Four -->
    <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="card card-warning">
                <div class="card-header">
                    <div class="pull-left">
                        <i class="fa fa-list fa-fw fa-4x"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $cat_count ?></h1>
                        <h3>Categories</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="pull-left"><a href="?pages=categories" class="stretched-link">View More</a></span>
                    <span class="pull-right"><i class="fa fa-angle-double-right fa-lg"></i></span>
                </div>
            </div>
        </div>

        
    </div>

</div>

<div class="container mb-5">
<h1>Charts</h1>
    <canvas id="myChart"></canvas>
</div>

<script>
    var myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'sans-serif';
    Chart.defaults.global.defaultFontSize = 12;
    Chart.defaults.global.defaultFontColor = '#777';

    var adminChart = new Chart(myChart, {
        type:'bar',
        data:{
            labels: ['All Posts', 'Published', 'Draft', 'Comments', 'Users', 'Categories'],
            datasets:[{
                label:'Counts',
                data:[
                    <?php echo $post_count ?>,
                    <?php echo $published_post_count ?>,
                    <?php echo $draft_post_count ?>,
                    <?php echo $comment_count ?>,
                    <?php echo $user_count ?>,
                    <?php echo $cat_count ?>
                ],
                backgroundColor:[
                    '#007bff',
                    '#17a2b8',
                    '#6c757d',
                    '#dc3545',
                    '#28a745',
                    '#ffc107'
                ],
                borderWidth:1,
                borderColor:'#777',
                hoverBorderWidth:2,
                hoverBorderColor:'#000'
            }]
        },
        options:{
            legend:{
                display:true,
                position:'right'
                
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>