
/*
 baseUrl is comming from the script include from page
 */

$("form#adminLogin").on("submit",function (e) {
    e.preventDefault();
    var userName = $("#userName").val();
    var userPassword = $("#userPassword").val();
    var _token = $("#_token").val();

    var formAction = $("#adminLogin").attr("action");
    $.ajax({
        url: formAction,
        method:"POST",
        data:{
            userName:userName,
            userPassword:userPassword,
            _token:_token
        },
        dataType:'json',
        success:function (response) {

        },
        error: function(errorResponse) {
            if (errorResponse.responseJSON.errors.userName){
                $("#usernameError").show();
                $("#usernameError").html((errorResponse.responseJSON.errors.userName));
            }else{
                $("#usernameError").hide();
            }
            if (errorResponse.responseJSON.errors.userPassword){
                $("#userPasswordError").show();
                $("#userPasswordError").html((errorResponse.responseJSON.errors.userPassword));
            }else{
                $("#userPasswordError").hide();
            }
            console.log(errorResponse.responseJSON.errors);
        }
    });
});
