<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 11:25 PM
 */

require("../Config/databaseConnection.php");

session_start();

if($_POST){

    $email = addslashes($_POST['email']);
    $password = md5($_POST['password']);

    $select_sql = "SELECT *FROM user WHERE email_address='$email' and password='$password' and status=1";

//    echo $select_sql;
    $result = mysqli_query($connection,$select_sql);

    $rows_count = mysqli_num_rows($result);

    $rows = mysqli_fetch_assoc($result);

    if($rows_count > 0){
        $_SESSION['first_name'] = $rows["first_name"];
        $_SESSION['last_name'] = $rows["last_name"];
        $_SESSION['id'] = $rows["id"];

        header("Location:../Views/dashboard.php");
    }else{
        $_SESSION['msg']="Wrong username or password.";
        header("Location:../Views/home.php");
    }

}