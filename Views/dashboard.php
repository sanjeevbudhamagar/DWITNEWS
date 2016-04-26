<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 11:50 PM
 */
session_start();
require('../Config/databaseConnection.php');
require('../Common/Common.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DWIT News</title>

        <link href="../CSS/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="../CSS/news.css" type="text/css" rel="stylesheet">

        <script src="../JS/jquery-1.12.0.min.js" type="text/javascript"></script>
        <script src="../JS/bootstrap.min.js" type="text/javascript"></script>

    </head>

    <body>
        <?php
            require('../Views/Layout/header.php');
        ?>

        <div id="content">
            <?php

            $userList = array();
            $objCommon = new Common();
            $userList = $objCommon->getUser();


            echo '
                <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Mobile Number</th>
                                <th>Phone Number</th>
                                <th>Email Address</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>';

            foreach($userList as $user){

                if($user['status']==0){
                    $status = "Inactive";
                }
                else {
                    $status = "Active";
                }

                echo'
                    <tr>
                        <td><img class="img-circle" src="../Images/profile_pictures/'.$user["profile_picture"].'" style="height: 70px;width:70px;"></td>
                        <td>'.$user["first_name"].'&nbsp;'.$user["last_name"].'</td>
                        <td>'.$user["mobile_number"].'</td>
                        <td>'.$user["phone_number"].'</td>
                        <td>'.$user["email_address"].'</td>
                        <td>'.$user["role"].'</td>
                        <td>'.$status.'</td>
                    </tr>

                ';
            }

            echo'
                    </tbody>
                </table>
            ';

            ?>
        </div>

        <?php
            require('../Views/Layout/footer.php');
        ?>
    </body>
</html>

