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

    $news_headline = $_POST['newsHeadline'];
    $news_body = $_POST['newsBody'];
    $category = $_POST['category'];
    $search_keyword = $_POST['searchKeyword'];

    $news_image = $_FILES['newsImage']['name'];
    $news_image_tmp = $_FILES['newsImage']['tmp_name'];

    move_uploaded_file($news_image_tmp,"../Images/news_image/$news_image");

    $result = array();
    $result = $objCommon->createNews($news_headline,$news_body,$category,$search_keyword,$news_image);

    if($result['message']=='success'){
        $_SESSION['add'] ="success";
    } else {
        $_SESSION['add'] ="error";
    }

    header('Location:../Views/news.php');
}

if($_POST["mode"]=="edit"){

    $id = $_POST['user_id'];
    $news_headline = $_POST['newsHeadline'];
    $news_body = $_POST['newsBody'];
    $category = $_POST['category'];

    $result = $objCommon->updateNews($news_headline,$news_body,$category,$id);

    if($result){
        $_SESSION['edit'] ="success";
    } else {
        $_SESSION['edit'] ="error";
    }

    header('Location:../Views/news.php');
}

if($_POST["mode"]=="delete"){

    $id = $_POST['id'];

    $result = $objCommon->deleteNews($id);

    if($result){
        $responseArray['message'] ="success";
    } else {
        $responseArray['message'] ="error";
    }

    echo json_encode($responseArray);
}