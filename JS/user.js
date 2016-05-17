/**
 * Created by sanjeev-budha on 4/24/16.
 */


/*
function saveUser(){
    //var form_data = $('#user-form').serialize();
    var form_data = new FormData(this);
    alert(form_data.get('firstName'));
    $.ajax({
        type:'POST',
        url:'../Controller/userHandler.php',
        data:form_data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
           var data = JSON.parse(data);
            alert(data.message);

        },
        error:function(err){
            alert(err);
        }

    });

    return false;
}*/


function editUser(incomingId){

    var id = '#' + incomingId;

    var firstName = $(id).children('#first-name').text();
    var lastName = $(id).children('#last-name').text();
    var mobileNumber = $(id).children('#mobile-number').text();
    var phoneNumber = $(id).children('#phone-number').text();
    var emailAddress = $(id).children('#email-address').text();
    var address = $(id).children('#address1').text();
    var role = $(id).children('#role1').text();
    var status = $(id).children('#status1').text();

    $("#first_name").val(firstName);
    $("#last_name").val(lastName);
    $('#mobile_number').val(mobileNumber);
    $('#phone_number').val(phoneNumber);
    $('#email_address').val(emailAddress);
    $('#address').val(address);
    $('#role').val(role);

    if(status=='Active'){
        $('#status1').attr('checked');
    }
    else{
        $('#status2').attr('checked',true);
    }


    $('#insert-user').modal('show');
    $('#insert-user #profile-img').hide();
    $('#insert-user .modal-title').html("Edit this User");
    $('#insert-user button[type=submit]').html("Save Changes");
    $('#user-form').attr('action','../Controller/userHandler.php');
    $('#mode').attr('value','edit');
    $('#user_id').attr('value',incomingId);

}

function deleteUser(incomingId){

    var id = '#' + incomingId;
    var mode ='delete';

    var firstName = $(id).children('#first-name').text();
    var lastName = $(id).children('#last-name').text();

    var choice = confirm("Are you sure you want delete "+firstName+" " + lastName);

    if(choice){

        $.ajax({
            type:"POST",
            url:'../Controller/userHandler.php',
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

function profileView(id){

    var mode = "view";

    $.ajax({
        type:"POST",
        url:'../Controller/userHandler.php',
        data:"mode="+mode+"&id="+id,
        success:function(data){
            var data = JSON.parse(data);
            var image_url = "../Images/profile_pictures/"+data['user'].profile_picture;

            $('#view_profile').modal('show');
            $('#view_profile .modal-title').html("Profile");
            $('#view_profile #fullName').html(data['user'].first_name + " " + data['user'].last_name);
            $('#view_profile #address').html(data['user'].address);
            $('#view_profile #mobileNumber').html(data['user'].mobile_number);
            $('#view_profile #phoneNumber').html(data['user'].phone_number);
            $('#view_profile #emailAddress').html(data['user'].email_address);
            $('#view_profile img').attr("src",image_url);

            var number = 1;
            for(var i = 0; i < data['news'].length; i++){
                var date_updated = data['news'][i].last_updated?data['news'][i].last_updated:'Not Updated';

                var tdList = "<tr><td>"+number+"</td><td>"+data['news'][i].news_headline+"</td><td>"+data['news'][i].created_date+"</td><td>"+date_updated+"</td></tr>";
                number++;
                $('#newsListBody').append(tdList)
            }

        },error: function (er) {
            alert("Error while Creating" +er);
        }
    });
}