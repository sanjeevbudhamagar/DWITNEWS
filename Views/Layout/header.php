<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 9:44 PM
 */
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>DWIT NEWS</title>
        <link href="/CSS/news.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <header class="container-fluid">
        <img src="../Images/dwitnews.png" title="DWIT NEWS">
        <ul style="list-style: none; float: right; padding-top: 2%; position: relative; margin-right: 2%;">
            <?php
                if($_SESSION['id']){
                    echo'<li style="float: left; margin-right: 20px; cursor: pointer;"><a href="../Controller/logout.php">Logout</a> </li>';
                }
            else{
                echo' <li style="float: left; margin-right: 20px; cursor: pointer;"><a data-toggle="modal" data-target="#login">Login</a> </li>';
            }
            ?>
        </ul>
    </header>

    <nav class="navbar navbar-inverse" style="border: none;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="menu">
                <?php
                    if($_SESSION['id']){
                        echo '
                            <ul class="nav navbar-nav">
                                <li><a href="../Views/dashboard.php">Home</a></li>
                                <li>
                                    <!--<div class="dropdown">
                                        <a href="#"><button class="dropbtn">User Management</button></a>
                                        <div class="dropdown-content">
                                        <a href="#">Add User</a>
                                        <a href="#">Admin</a>
                                        <a href="#">Editor</a>
                                        <a href="#">Reporter</a>
                                      </div>
                                    </div>-->
                                    <a href="../Views/user.php">User Management</a>
                                </li>
                                <li><!--<div class="dropdown">
                                        <button class="dropbtn">News Management</button>
                                        <div class="dropdown-content">
                                        <a href="#">Add News</a>
                                        <a href="#">Sports</a>
                                        <a href="#">Social News</a>
                                        <a href="#">Club Activities</a>
                                      </div>
                                    </div>-->
                                    <a href="../Views/news.php">News Management</a>
                                </li>

                            </ul>

                            <ul class="nav navbar-nav pull-right">
                                <li><a>Welcome &nbsp;'.$_SESSION["first_name"].'&nbsp;'.$_SESSION["last_name"].'</a></li>
                            </ul>
                            ';


                    }
                    else{
                        echo'
                            <ul class="nav navbar-nav">
                            <li><a>Home</a></li>
                            <li><a>Sports</a></li>
                            <li><a>Social</a></li>
                            <li><a>Club Activities</a></li>
                            <li><a>Contact</a></li>
                            <li><a>About</a></li>
                        </ul>
                        ';
                    }
                ?>
            </div>
        </div>
    </nav>


    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #0F5288">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="news-text">Login</h2>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal" role="form" id="login-form" method="post" action="../Controller/login.php">
                        <?php
                            if($_SESSION['msg']){
                                echo'<div class="alert alert-danger"><p>Invalid username or/and password</p></div>';
                            }
                        ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email"><span class="glyphicon glyphicon-envelope"/></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd"><span class="glyphicon glyphicon-lock"/></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox"/>Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-check"/>Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="modal-footer" style="background-color: #0F5288">
                    <p class="news-text">Forgot Password?It's OK<button class="btn btn-success">Recover Here</button></p>
<!--                    <p class="news-text">Don't Have an account?<button class="btn btn-danger">Register Now</button></p>-->
                </div>

            </div>
        </div>
    </div>

    </body>
</html>