<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/5/2019
 * Time: 6:45 PM
 */

namespace App\classes;

class User
{
    public function adminLoginCheck(){
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE email = '$_POST[email]' AND password = '$password'";
        if($queryResult = mysqli_query(Database::dbConnection(),$sql)){
            $user = mysqli_fetch_assoc($queryResult);
            if($user){
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                header('Location:dashboard.php');
            } else {
                header('Location:index.php');
            }
        }
    }

    public function adminLogout(){
        unset($_SESSION['id']);
        unset($_SESSION['name']);

        header('Location:index.php');
    }
}