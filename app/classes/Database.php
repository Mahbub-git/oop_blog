<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/5/2019
 * Time: 6:45 PM
 */

namespace App\classes;


class Database
{
    public function dbConnection(){
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "lara3php";

        $link = mysqli_connect($hostName,$userName,$password,$dbName);
        return $link;
    }
}