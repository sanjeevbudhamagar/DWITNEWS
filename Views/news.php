<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/23/16
 * Time: 11:12 PM
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
    <script src="../JS/news.js" type="text/javascript"></script>

</head>

<body>
    <?php
        require('../Views/Layout/header.php');
    ?>
    <div id="content">


        <button class="btn btn-default" id="add-news"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Add News</button>

        <hr>
        <?php

        $newsList = array();
        $objCommon = new Common();
        $newsList = $objCommon->getNews();


        echo '
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>News Headline</th>
                                <th>News Body</th>
                                <th>Created Date</th>
                                <th>Last Updated</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>';

        foreach($newsList as $news){

            $id = $news["id"];
            echo'
                    <tr id="'.$id.'">
                                <td><img class="img-thumbnail" src="../Images/news_images/'.$news["image"].'" style="height: 70px;width:80px;"></td>
                                <td id="news-headline">'.$news["news_headline"].'</td>
                                <td id="news-body">'.$news["news_body"].'</td>
                                <td id="created-date">'.$news["created_date"].'</td>
                                <td id="last-updated">'.$news["last_updated"].'</td>
                                <td id="category1">'.$news["cat_id"].'</td>
                                <td>
                                    <button class="btn btn-primary" title="EDIT" onclick="return editNews('.$id.');"><i class="glyphicon glyphicon-edit"></i></button>
                                    <button class="btn btn-danger" title="DELETE" onclick="return deleteNews('.$id.');"><i class="glyphicon glyphicon-trash"></i></button>
                                    <button class="btn btn-info" title="DETAILS"><i class="glyphicon glyphicon-info-sign"></i></button>
                                </button></td>
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


    <div class="modal fade" id="insert-news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title"></h2>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal" role="form" id="news-form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="mode" id="mode">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="news_headline">News Headline</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="news_headline" name="newsHeadline" placeholder="Enter News Headline">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="news_body">News Body</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="news_body" name="newsBody" style="width: 100%;height:250px"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="category">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="category" name="category">
                                    <option value="Sports">Sports</option>
                                    <option value="Social">Social</option>
                                    <option value="Club Activities">Club Activities</option>
                                </select>
                            </div>
                        </div>
                        <div id="news-img" class="form-group">
                            <label class="control-label col-sm-4" for="search_keyword">Search Keywords</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="search_keyword" name="searchKeyword" placeholder="Enter Search Keywords">
                            </div>
                        </div>

                        <div id="news-img" class="form-group">
                            <label class="control-label col-sm-4" for="news_image">News Image</label>

                            <input type="file" id="news_image" name="newsImage" >
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

        $('#add-news').click(function(){
        $('#insert-news').modal('show');
        $('#insert-news .modal-title').html("Add News");
        $('#insert-news button[type=submit]').html("Save News");
        $('#news-form').attr('action','../Controller/newsHandler.php');
        $('#mode').attr('value','add');

        });

        $('.modal').on('hidden.bs.modal', function(){
            $(this).find('form')[0].reset();
        });
    </script>
</body>
</html>