<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/23/16
 * Time: 10:04 PM
 */

session_start();
unset($_SESSION['id']);
session_destroy();

header('Location:../Views/home.php');