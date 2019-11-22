<?php
session_start();
require "../vendor/autoload.php";
use App\classes\Post;
$post = new Post;
$queryResult = $post->getCategoryInfo();
$message='';
if(isset($_POST['btn'])){
    $message = $post->addNewPost();
}



?>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include "include/navbar.php" ?>
<div class="container">
    <div class="row">
        <div class="offset-2 col-md-8 mt-5">
            <?php if($message){ ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $message; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header text-center">
                    <h4>Add Post</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="cat_id" class="form-control">
                                <option>--Select Category Name---</option>
                                <?php while($category = mysqli_fetch_assoc($queryResult)) { ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['cat_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Post Title</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Post Short Description</label>
                            <textarea name="post_short_desc" class="form-control" placeholder="Enter Post Description" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Long Description</label>
                            <textarea name="post_long_desc" class="form-control" placeholder="Enter Post Description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Image</label>
                            <input type="file" name="post_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Publication Status</label>
                            <select class="form-control" name="status">
                                <option>-Select Publication Status-</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                        <button type="submit" name="btn" class="btn btn-primary">Add Post</button>
                    </form>
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
