
/*
 baseUrl is comming from the script include from page
 */

$("form#adminLogin").on("submit",function (e) {
    e.preventDefault();
    var userName = $("#userName").val();
    var userPassword = $("#userPassword").val();
    var _token = $("#_token").val();

    var formAction = $("#adminLogin").attr("action");
    if (userName !='' && userPassword !=''){
        $("#loaderIcon").show('fast');
    }
    $.ajax({
        url: formAction,
        method:"POST",
        data:{
            userName:userName,
            userPassword:userPassword,
            _token:_token,
            userType:1
        },
        dataType:'json',
        success:function (response) {
           // if (response.respose)
            console.log(response.success);
            if (response.success){
                $("#usernameError").hide();
                $("#userPasswordError").hide();
            }

            if (response.status == 1){
                window.location.href  = response.successUrl;
            }else{
                alert("login failed");
            }
            $("#loaderIcon").hide('fast');
        },
        error: function(errorResponse) {
            console.log(errorResponse.responseJSON.errors);

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
            $("#loaderIcon").hide('fast');
        }
    });
});
