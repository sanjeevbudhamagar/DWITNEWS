<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/24/16
 * Time: 2:31 AM
 */

require('../Common/Common.php');

$objCommon = new Common();

if($_POST["mode"]=="add"){

    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $mobile_number = $_POST['mobileNumber'];
    $phone_number = $_POST['phoneNumber'];
    $address = $_POST['addresses'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $email_address = $_POST['emailAddress'];

    $profile_picture = $_FILES['profileImg']['name'];
    $profile_picture_tmp = $_FILES['profileImg']['tmp_name'];

    move_uploaded_file($profile_picture_tmp,"../Images/profile_pictures/$profile_picture");

    $result = $objCommon->createUser($first_name,$last_name,$mobile_number,$phone_number,$address,$role,$status,$email_address,$profile_picture);

    if($result){
        $_SESSION['add'] ="success";
    } else {
        $_SESSION['add'] ="error";
    }

    header('Location:../Views/user.php');
}

if($_POST["mode"]=="edit"){

    $id = $_POST['user_id'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $mobile_number = $_POST['mobileNumber'];
    $phone_number = $_POST['phoneNumber'];
    $address = $_POST['addresses'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $email_address = $_POST['emailAddress'];

    $result = $objCommon->updateUser($first_name,$last_name,$mobile_number,$phone_number,$address,$role,$status,$email_address,$id);


    if($result){
        $_SESSION['edit'] ="success";
    } else {
        $_SESSION['edit'] ="error";
    }

    header('Location:../Views/user.php');
}

if($_POST["mode"]=="delete"){

    $id = $_POST['id'];

    $result = $objCommon->deleteUser($id);

    if($result){
        $responseArray['message'] ="success";
    } else {
        $responseArray['message'] ="error";
    }

    echo json_encode($responseArray);
}