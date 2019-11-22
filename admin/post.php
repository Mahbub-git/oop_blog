<?php
session_start();
require "../vendor/autoload.php";
use App\classes\Post;
$post = new Post;
$result = $post->getAllPost();
?>

<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font-awesome style -->
    <link href="admin-panel-assets/font-awesome/css/all.css" rel="stylesheet">
    <!-- font-awesome style ends./ -->

</head>
<body>
<?php include "include/navbar.php" ?>

<div class="container">
    <div class="row">
        <div class="offset-1 col-md-10 mt-5">



            <div class="card">
                <div class="card-header">
                    <span class="h4">Post List
                    <a href="add-post.php" class="btn btn-primary float-right">Add Post</a></span>
                </div>
                <div class="">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sl.</th>
                            <th>Category Name</th>
                            <th>Post Title</th>
                            <th>Post Short Description</th>
                            <th>Post Image</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        while ($post = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $post['cat_name'] ?></td>
                            <td><?php echo $post['post_title'] ?></td>
                            <td><?php echo $post['post_short_desc'] ?></td>
                            <td><img src="<?php echo $post['post_image'] ?>" width="200"></td>
                            <td><?php echo $post['status']==1?'Published':'Unpublished' ?></td>
                            <td>
                                <a href="edit-post.php?id=<?php echo $post['id'] ?>"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

