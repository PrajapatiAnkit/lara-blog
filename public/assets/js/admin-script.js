
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
            userType:1,
            validationRule:'adminLogin'
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

$("form#addBlogForm").on('submit',function (e) {
   e.preventDefault();
    var blogTitle = $("#blogTitle").val();
    var blogCategory = $("#blogCategory").val();
    var blogDescription = $("#blogDescription").val();
    var _token = $("#_token").val();
    var validationRule = $("#validationRule").val();

    var formAction = $("#addBlogForm").attr("action");

    $.ajax({
        url: formAction,
        method:"POST",
        data:{
            blogTitle:blogTitle,
            blogCategory:blogCategory,
            blogDescription:blogDescription,
            _token:_token,
            validationRule:validationRule,
        },
        dataType:'json',
        success:function (response) {
            console.log(response);
            if (response.status == 1){
                $("#showSuccess").show('fast');
                $("#showSuccess").html(response.message);
                $("#showSuccess").fadeOut(4000);
                $("#addBlogForm").each(function () {
                    this.reset();
                });
            }
        },
        error: function(errorData) {
           // console.log(errorData.status)
           var errors = errorData.responseJSON;
           var errorsHtml = '<div class="alert alert-danger"><ul>';

           if (errorData.status  == 422){
               $.each(errors.errors,function (key,value) {
                   errorsHtml += '<li>' + value[0] + '</li>';
               });
               errorsHtml += '</ul></div>';
               $('#showErrors').html( errorsHtml );
           }else{
               $('#showErrors').hide();
           }

        }
    });

});


$("form#resetPassword").on('submit',function (e) {
    e.preventDefault();
    var currentPassword = $("#currentPassword").val();
    var _token = $("#_token").val();
    var formAction = $("#resetPassword").attr("action");

    $.post(formAction,{currentPassword:currentPassword,_token:_token},function (response) {
     //   alert(response);
        console.log(response);
    })

});

