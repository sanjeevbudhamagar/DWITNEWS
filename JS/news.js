/**
 * Created by sanjeev-budha on 4/21/16.
 */

function loginCheck(){

    var data = $('#login-form').serialize();

    alert(data);
    $.ajax({
        type:"POST",
        url:'Controller/login.php',
        data:data,
        success:function(data){
            var data = JSON.parse(data)

            if(data.success){
                alert(data);
                document.location = "../Views/dashboard";

            }else{
                alert("Unable to login");
            }
        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });
    return false;

}

function editNews(incomingId){

    var id = '#' + incomingId;

    var news_headline = $(id).children('#news-headline').text();
    var news_body = $(id).children('#news-body').text();
    var created_date = $(id).children('#created-date').text();
    var updated_date = $(id).children('#updated_date').text();
    var category = $(id).children('#category1').text();

    $("#news_headline").val(news_headline);
    $("#news_body").val(news_body);
    $('#created_date').val(created_date);
    $('#updated_date').val(updated_date);
    $('#category').val(category);


    $('#insert-news').modal('show');
    $('#insert-news #news-img').hide();
    $('#insert-news .modal-title').html("Edit this News");
    $('#insert-news button[type=submit]').html("Save Changes");
    $('#user-form').attr('action','../Controller/newsHandler.php');
    $('#mode').attr('value','edit');
    $('#user_id').attr('value',incomingId);

}

function deleteNews(incomingId){

    var mode ='delete';

    var choice = confirm("Are you sure you want delete");

    if(choice){

        $.ajax({
            type:"POST",
            url:'../Controller/newsHandler.php',
            data:"mode="+mode+"&id="+incomingId,
            success:function(data){
                var data = JSON.parse(data)

                if(data.message=='success'){
                    window.location.reload();
                }else{
                    alert("Unable to login");
                }
            },error: function (er) {
                alert("Error while Creating" +er);
            }
        });
        return false;

    }

}
