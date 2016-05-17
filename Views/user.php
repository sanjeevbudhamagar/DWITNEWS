<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/23/16
 * Time: 11:11 PM
 */

session_start();
require('../Config/databaseConnection.php');
require('../Common/Common.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DWIT News</title>

    <link href="../CSS/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="../CSS/news.css" type="text/css" rel="stylesheet"/>

    <script src="../JS/jquery-1.12.0.min.js" type="text/javascript"></script>
    <script src="../JS/bootstrap.min.js" type="text/javascript"></script>
    <script src="../JS/user.js" type="text/javascript"></script>

</head>

<body>
    <?php
        require('../Views/Layout/header.php');
    ?>

    <div id="content">


        <button class="btn btn-default" id="add-user"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Add User</button>

        <hr>
        <?php

        $userList = array();
        $objCommon = new Common();
        $userList = $objCommon->getUser();

        echo '
                <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile Number</th>
                                <th>Phone Number</th>
                                <th>Email Address</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>';

        foreach($userList as $user){

            if($user['status']==0){
                $status = "Inactive";
            }
            else{
                $status = "Active";
            }
            $id = $user['id'];

            echo'
                    <tr id="'.$id.'">
                        <td style="vertical-align: middle;"><img class="img-circle" src="../Images/profile_pictures/'.$user["profile_picture"].'" style="height: 70px;width:70px;"></td>
                        <td style="vertical-align: middle;" id="first-name">'.$user["first_name"].'</td>
                        <td style="vertical-align: middle;" id="last-name">'.$user["last_name"].'</td>
                        <td style="vertical-align: middle;" id="mobile-number">'.$user["mobile_number"].'</td>
                        <td style="vertical-align: middle;" id="phone-number">'.$user["phone_number"].'</td>
                        <td style="vertical-align: middle;" id="email-address">'.$user["email_address"].'</td>
                        <td style="vertical-align: middle;" id="address1">'.$user["address"].'</td>
                        <td style="vertical-align: middle;" id="role1">'.$user["role"].'</td>
                        <td style="vertical-align: middle;" id="status1">'.$status.'</td>
                        <td style="vertical-align: middle;">
                            <button class="btn btn-primary" onclick="return editUser('.$id.');" title="EDIT"><i class="glyphicon glyphicon-edit"></i></button>
                            <button class="btn btn-danger" title="DELETE" onclick="return deleteUser('.$id.');"><i class="glyphicon glyphicon-trash"></i></button>
                            <button class="btn btn-info" title="DETAILS"><i class="glyphicon glyphicon-info-sign"></i></button>
                        </td>
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


    <div class="modal fade" id="insert-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title"></h2>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal" role="form" id="user-form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="mode" id="mode">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="first_name">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="first_name" name="firstName" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="last_name">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="last_name" name="lastName" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="mobile_number">Mobile Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mobile_number" name="mobileNumber" placeholder="Enter Mobile Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="phone_number">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone_number" name="phoneNumber" placeholder="Enter Phone Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email_address">Email Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email_address" name="emailAddress" placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="address">Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="addresses" placeholder="Enter Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="role">Role</label>
                            <div class="col-sm-8">
                               <select id="role" name="role" class="form-control">
                                   <option>WRITER</option>
                                   <option>EDITOR</option>
                                   <option>ADMIN</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="status">Status</label>
                            <div class="col-sm-8">
                                <input type="radio" id="status1" name="status" value="active" checked>Active
                                <input type="radio" id="status2" name="status" value="inactive">InActive
                            </div>
                        </div>
                        <div id="profile-img" class="form-group">
                            <label class="control-label col-sm-4" for="profile-picture">Profile Picture</label>

                            <input type="file" id="profile-picture" name="profileImg">
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="save-user" onclick="$('form').submit()"></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>




    <script type="text/javascript">
        $('#add-user').click(function(){
            $('#insert-user').modal('show');
            $('#insert-user .modal-title').html("Add New User");
            $('#insert-user button[type=submit]').html("Save User");
            $('#user-form').attr('action','../Controller/userHandler.php');
            $('#mode').attr('value','add');

        });

        /*$('#edit-user').click(function(){



        });*/
    </script>
</body>
</html>