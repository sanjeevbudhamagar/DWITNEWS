<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 9:24 PM
 */

require('../Config/databaseConnection.php');
class Common {


//    public $connection;

//    function __construct()
//    {
//        global $connection;
//        $this->connection = $connection;
//    }

    public function getUser(){

        global $connection;
        $result = mysqli_query($connection,"SELECT  *FROM user");
        $data = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['email_address'] = $row["email_address"];
            $data[$i]['status'] = $row["status"];
            $data[$i]['role'] = $row["role"];
            $data[$i]['first_name'] = $row["first_name"];
            $data[$i]['last_name'] = $row["last_name"];
            $data[$i]['mobile_number'] = $row["mobile_number"];
            $data[$i]['phone_number'] = $row["phone_number"];
            $data[$i]['address'] = $row["address"];
            $data[$i]['profile_picture'] = $row["profile_picture"];
            $i++;
        }
        return $data;
    }

    public function createUser($fName,$lName,$mNumber,$pNumber,$address,$role,$status,$email_address,$profile_picture){

        global $connection;

        $pwd = md5('123');
        $created_date = date("Y-m-d");
        if($status=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        $create_user = "INSERT INTO user VALUES(null,'$fName','$lName','$mNumber','$pNumber','$address','$role','$status','$email_address','$profile_picture','$pwd','$created_date')";

        $result = mysqli_query($connection,$create_user);

        return $result;
    }

    public function editUser($id){

        global $connection;

        $select_query = "SELECT *FROM user WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['email_address'] = $row["email_address"];
            $data[$i]['status'] = $row["status"];
            $data[$i]['role'] = $row["role"];
            $data[$i]['first_name'] = $row["first_name"];
            $data[$i]['last_name'] = $row["last_name"];
            $data[$i]['mobile_number'] = $row["mobile_number"];
            $data[$i]['phone_number'] = $row["phone_number"];
            $data[$i]['address'] = $row["address"];
            $data[$i]['profile_picture'] = $row["profile_picture"];
            $i++;
        }
        return $data;

    }

    public function deleteUser($id){

        global $connection;

        $delete_user = "DELETE FROM user WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_user);

        return $result;

    }


    public function updateUser($fName,$lName,$mNumber,$pNumber,$address,$role,$status,$email_address,$id){

        global $connection;

        $password = md5('123');

        $update_date = date("Y-m-d");
        if($status=='active'){
            $status=1;
        }
        else{
            $status=0;
        }
        $update_user = "UPDATE user SET first_name = '$fName',last_name='$lName',mobile_number='$mNumber',phone_number='$pNumber',address='$address',role='$role',email_address='$email_address',status='$status',last_updated='$update_date' WHERE id='$id'; ";
        $result = mysqli_query($connection,$update_user);

        return $result;

    }

    public function getNews(){
        global $connection;

        $news_sql = "SELECT *FROM news";

        $result = mysqli_query($connection,$news_sql);

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['news_headline'] = $row["news_headline"];
            $data[$i]['news_body'] = $row["news_body"];
            $data[$i]['created_date'] = $row["created_date"];
            $data[$i]['last_updated'] = $row["last_updated"];
            $data[$i]['search_keywords'] = $row["search_keywords"];
            $data[$i]['cat_id'] = $row["category"];
            $data[$i]['image'] = $row["image"];
            $i++;
        }
        return $data;

    }

    public function editNews($id){
        global $connection;

        $select_query = "SELECT *FROM news WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['news_headline'] = $row["news_headline"];
            $data[$i]['news_body'] = $row["news_body"];
            $data[$i]['created_date'] = $row["created_date"];
            $data[$i]['last_updated'] = $row["last_updated"];
            $data[$i]['search_keywords'] = $row["search_keywords"];
            $data[$i]['cat_id'] = $row["category"];
            $data[$i]['image'] = $row["image"];
            $i++;
        }
        return $data;

    }
    public function createNews($news_headline,$news_body,$category,$search_keyword,$news_image){

        global $connection;

        $created_date = date("Y-m-d");

        $create_news = "INSERT INTO news VALUES(null,'$news_headline','$news_body','$created_date',null,'$search_keyword','$category','$news_image')";

        $result = mysqli_query($connection,$create_news);

        return $result;

    }

    public function deleteNews($id){

        global $connection;

        $delete_news = "DELETE FROM news WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_news);

        return $result;
    }

    public function updateNews($news_headline,$news_body,$category,$id){

        global $connection;

        $updated_date = date("Y-m-d");

        $update_news = "UPDATE news SET news_headline = '$news_headline',news_body='$news_body',category='$category',last_updated='$updated_date' WHERE id='$id'; ";

        $result = mysqli_query($connection,$update_news);

        return $result;


    }
}