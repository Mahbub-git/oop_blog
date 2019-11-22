<?php

namespace App\classes;

class Category
{
    public function addCategory(){
        $sql = "INSERT INTO categories(cat_name,cat_desc,status) VALUES ('$_POST[cat_name]','$_POST[cat_desc]','$_POST[status]')";
        if(mysqli_query(Database::dbConnection(),$sql)){
            return "Category Added Successfully";
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getAllCategory(){
        $sql = "SELECT * FROM categories";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE id = '$id'";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function updateCategory(){
        $sql = "UPDATE categories SET cat_name='$_POST[cat_name]', cat_desc='$_POST[cat_desc]', status = '$_POST[status]' WHERE id = '$_POST[id]'";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $_SESSION['message'] = "Category updated successfully!";
            header('Location:category.php');
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }     
    }

    public function deleteCategory($id){
        $sql = "DELETE FROM categories WHERE id = '$id'";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $_SESSION['message1'] = "Category Deleted successfully!";
            header('Location:category.php');
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }
}