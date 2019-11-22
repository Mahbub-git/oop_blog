<?php
session_start();
require "../vendor/autoload.php";
use App\classes\Category;
use App\classes\User;
$_SESSION['message']='';
$category = new Category;

$result = $category->getAllCategory();

if(isset($_GET['delete'])){
    $category->deleteCategory($_GET['id']);
}

$user = new User();
if(isset($_GET['logout'])){
    $user->adminLogout();
}
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
        <div class="offset-2 col-md-8 mt-5">

            <?php if($_SESSION['message']){ ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><?php echo $_SESSION['message']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php } ?>
<!--            --><?php //if(isset($_SESSION['message1'])){ ?>
<!--                <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
<!--                    <strong>--><?php //echo $_SESSION['message1']; ?><!--</strong>-->
<!--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
<!--                </div>-->
<!--                --><?php //unset($_SESSION['message1']); ?>
<!--            --><?php //} ?>

            <div class="card">
                <div class="card-header">
                    <span class="h4">Category List 
                    <a href="add-category.php" class="btn btn-primary float-right">Add Category</a></span>
                </div>
                <div class="">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sl.</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        while($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $data['cat_name'] ?></td>
                            <td><?php echo $data['cat_desc'] ?></td>
                            <td><?php echo $data['status'] == 1?'Publised':'Unpublished' ?></td>
                            <td>
                                <a href="edit-category.php?id=<?php echo $data['id'] ?>"><i class="far fa-edit"></i></a>
                                <a href="?delete=true&id=<?php echo $data['id'] ?>" onclick="return confirm('Are you sure to delete category?')"><i class="fas fa-trash-alt"></i></a>
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
