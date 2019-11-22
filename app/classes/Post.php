<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/7/2019
 * Time: 6:39 PM
 */

namespace App\classes;

class Post
{
    public function getCategoryInfo(){
        $sql = "SELECT * FROM categories WHERE status = 1";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function addNewPost(){
        $imageName = $_FILES['post_image']['name'];
        $directory = 'post-images/';
        $imageUrl = $directory.$imageName;
        $fileType = pathinfo($imageName, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES['post_image']['tmp_name']);

        if($check){
            if(file_exists($imageUrl)){
                die('File Already Exists. Please Select ANother File');
            } else {
                if($fileType != 'jpg'){
                    die('Image Type not supported');
                } else {
                    if($_FILES['post_image']['size'] > 200000){
                        die('Image size is too big');
                    } else {
                        move_uploaded_file($_FILES['post_image']['tmp_name'],$imageUrl);
                        $sql = "INSERT INTO posts(cat_id,post_title,post_short_desc,post_long_desc,post_image,status) VALUES('$_POST[cat_id]','$_POST[post_title]','$_POST[post_short_desc]','$_POST[post_long_desc]','$imageUrl','$_POST[status]')";
                        if(mysqli_query(Database::dbConnection(),$sql)){
                            return "Post Added Successfully";
                        } else {
                            die('Query Problem'.mysqli_error(Database::dbConnection()));
                        }
                    }
                }
            }
        } else {
            echo 'Please upload a image file';
        }
    }

    public function getAllPost(){
        $sql = "SELECT p.*,c.cat_name FROM posts as p, categories as c WHERE p.cat_id=c.id";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getPostById($id){
        $sql = "SELECT * FROM posts WHERE id = '$id'";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function updatePost(){
        $imageName = $_FILES['post_image']['name'];
        if($imageName){
            $sql = "SELECT * FROM posts WHERE id='$_POST[id]'";
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            $data = mysqli_fetch_assoc($queryResult);
            unlink($data['post_image']);

            $directory = 'post-images/';
            $imageUrl = $directory.$imageName;
            $fileType = pathinfo($imageName, PATHINFO_EXTENSION);
            $check = getimagesize($_FILES['post_image']['tmp_name']);

            if($check){
                if(file_exists($imageUrl)){
                    die('File Already Exists. Please Select ANother File');
                } else {
                    if($fileType != 'jpg'){
                        die('Image Type not supported');
                    } else {
                        if($_FILES['post_image']['size'] > 200000){
                            die('Image size is too big');
                        } else {
                            move_uploaded_file($_FILES['post_image']['tmp_name'],$imageUrl);
                            $sql = "UPDATE posts SET cat_id='$_POST[cat_id]', post_title='$_POST[post_title]', post_short_desc = '$_POST[post_short_desc]', post_long_desc = '$_POST[post_long_desc]',post_image = '$imageUrl', status = '$_POST[status]' WHERE id = '$_POST[id]'";
                            if(mysqli_query(Database::dbConnection(),$sql)){
                                header('Location:post.php');
                            } else {
                                die('Query Problem'.mysqli_error(Database::dbConnection()));
                            }
                        }
                    }
                }
            } else {
                echo 'Please upload a image file';
            }
        } else {
            $sql = "UPDATE posts SET cat_id='$_POST[cat_id]', post_title='$_POST[post_title]', post_short_desc = '$_POST[post_short_desc]', post_long_desc = '$_POST[post_long_desc]', status = '$_POST[status]' WHERE id = '$_POST[id]'";
            if(mysqli_query(Database::dbConnection(),$sql)){
                header('Location:post.php');
            } else {
                die('Query Problem'.mysqli_error(Database::dbConnection()));
            }
        }



    }


}







