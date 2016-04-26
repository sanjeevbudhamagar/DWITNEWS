/**
 * Created by sanjeev-budha on 4/26/16.
 */
$(document).ready(function(){

    $.ajax({
        type:'GET',
        url:'../../WebService/index.php',
        data:"action=getNews",
        success:function(data){
            var result = JSON.parse(data);

            for(var i = 0; i < result.data.length;i++){
                var id = result.data[i].id;
                var title = result.data[i].news_headline;
                var body = result.data[i].news_body;
                var cat = result.data[i].cat_id;
                var image = result.data[i].image;

                var text = '<di style="height: 10%;"><ul data-role="listview" data-inset="true">'+
                '<li>'+
                '<div style="width: 20%;height: auto;float: left"><img id="news_picture" src="../../Images/news_image/'+image+'"/></div>'+
                '<div style="width: 70%;height: auto;float: right;">'+
                '<p id="news_title"><h1>'+title+'</h1></p>'+
                '<p id="news_body">'+body+'</p>'+
                '<p id="news_category">Category'+cat+'</p>'+
                '</div>'+
                '</li>'+
                '</ul></di>';

                $('#news').append(text);

            }

        },
        error:function(err){
            alert(err);
        }
    });

});