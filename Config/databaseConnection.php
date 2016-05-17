<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 9:27 PM
 */

    $server_name = "localhost";
    $username    = "root";
    $password    = "clockme";
    $db_name     = "dwitnews";

    /*Create Connection*/
    $connection = mysqli_connect($server_name,$username,$password,$db_name);

    /*Check Connection*/
    if(mysqli_connect_errno()){
        die("Connection failed: ".mysqli_connect_error());
    }

