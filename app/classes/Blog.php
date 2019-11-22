<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/7/2019
 * Time: 8:19 PM
 */

namespace App\classes;


class Blog
{
    public function getAllPost(){
        $sql = "SELECT * FROM posts WHERE status = 1";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            return $queryResult;
        } else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }
    public function getAllCategory(){
        $sql = "SELECT * FROM categories WHERE status = 1";
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
}