
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

            console.log(response);
            if (response.status == 0){
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
       /* data:{
            blogTitle:blogTitle,
            blogCategory:blogCategory,
            blogDescription:blogDescription,
            _token:_token,
            validationRule:validationRule,
        },*/
       data: new FormData(this),
       dataType:'json',
        contentType: false,
        cache: false,
        processData: false,
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
    var key = $("#key").val();
    var _token = $("#_token").val();
    var formAction = $("#resetPassword").attr("action");

    if (currentPassword == ''){
        $("#currentPasswordError").show();
        $("#currentPasswordError").html("Please enter current password");
        $("#currentPasswordError").fadeOut(4000);
    }else{
        if (key == 'verifyPassword') {
            $.post(formAction,{currentPassword:currentPassword,_token:_token,key:key},function (response) {
                console.log(response);
                if (response.statusValue == 1){
                    $("#resetDiv").show('fast');
                    $("#key").val('verified');

                }else if (response.statusValue == 0) {
                    $("#currentPasswordError").show();
                    $("#currentPasswordError").html("Current password not matched");
                    $("#currentPasswordError").fadeOut(4000);
                    $("#resetDiv").hide();
                }
            });
        }else if (key == 'verified'){
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();

            if (newPassword == ''){
                $("#newPasswordError").show();
                $("#newPasswordError").html("Please enter new password");
                $("#newPasswordError").fadeOut(4000);
            }else if (confirmPassword == ''){
                $("#confirmPasswordError").show();
                $("#confirmPasswordError").html("Please enter confirm password");
                $("#confirmPasswordError").fadeOut(4000);
            }else if (newPassword != confirmPassword){
                $("#confirmPasswordError").show();
                $("#confirmPasswordError").html("Confirm password not matched with new password");
                $("#confirmPasswordError").fadeOut(4000);

            }else {
                $.post(formAction,{key:key,newPassword:newPassword,_token:_token},function (responseData) {
                    console.log(responseData);
                    $("#showSuccess").show('fast');
                    $("#showSuccess").html("Your password updated !");
                    $("#resetDiv").hide('fast');
                    $("#key").val('verifyPassword');
                    $("form#resetPassword").each(function () {
                        this.reset();
                    })
                });
            }
        }

    }

});

function deleteCategory(deleteUrl) {
    if (confirm("Are you sure to delete ?")){
        window.location.href = deleteUrl;
    }
}
function deleteBlog(deleteUrl) {
    if (confirm("Are you sure to delete ?")){
        window.location.href = deleteUrl;
    }
}

/* comment */
$("form#commentForm").on('submit',function (e) {
    e.preventDefault();
    var commentText = $("#commentText").val();
    var blogId = $("#blogId").val();
    var _token = $("#_token").val();
    var editCommentId = $("#editCommentId").val();
    var formAction = $("#commentForm").attr("action");
    if (commentText == ''){
        $("#commentTextError").show();
        $("#commentTextError").html("Please type something");
        $("#commentText").focus();
    }else {
        $.post(formAction,{
            commentText:commentText,
            _token:_token,
            blogId:blogId,
            editCommentId:editCommentId
        },function (response) {

            var commentCount = response.commentCount;
            $("#commentCountLabel").html(commentCount);

            $("form#commentForm").each(function () {
                this.reset();
            });
         /*   var commentsData = '';

            for (var i=0; i<response.comments.length; i++) {
                var commentItem = response.comments[i];
                commentsData +='<li class="list-group-item"><img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg" width="30" style="border-radius: 50%;">  '+commentItem.comment+'</li>\n';
            }
            $("form#commentForm").each(function () {
                this.reset();
            });
            $("#commentsData").html(commentsData);*/
            getCommentsById(blogId);
        });
    }
});

function getCommentsById(blogId) {
    var _token = $("#_token").val();
    var myUserId = $("#myUserId").val();
    var commentsData = '';
    var editDeleteStyle = '';
    $.post("/admin/getCommentsById",{blogId:blogId,_token:_token},function (response) {
        //console.log(response.userId);

        if (response.comments.length>0){
            for (var i=0; i<response.comments.length; i++) {
                var commentItem = response.comments[i];
               // var commentId = response.comments[i];
                var commentAuthor = commentItem.userId;
               // console.log(commentAuthor);
                if (commentAuthor == myUserId){
                    editDeleteStyle = 'block';
                }else{
                    editDeleteStyle = 'none';
                }
                commentsData +='<li class="list-group-item">' +
                    '<img src="http://127.0.0.1:8000/static/adminator/randomuser.me/api/portraits/men/10.jpg"' +
                    ' width="30" style="border-radius: 50%;">  '+commentItem.comment+'' +
                    '<a href="javaScript:void();" style="display:'+editDeleteStyle+'" onclick="deleteComment('+blogId+','+commentItem.id+')" class="pull-right spaces-near-button"><i class="fa fa-trash delete-icon"></i></a>' +
                    '<a href="javaScript:void();" style="display:'+editDeleteStyle+'" onclick="editComment('+blogId+','+commentItem.id+',\''+commentItem.comment+'\')" class="pull-right spaces-near-button"><i class="fa fa-pencil"></i></a> </li>\n';
            }

        }else{
            commentsData ='<li class="list-group-item">Be the First one to comment !</li>\n';

        }
        $("#commentsData").html(commentsData);
        $("#editCommentId").val("");
        $("#writeCommentBtn").html("comment");
    });
}

function editComment(blogId,commentId,commentMessage) {
   $("#commentText").val(commentMessage);
   $("#editCommentId").val(commentId);

   $("#writeCommentBtn").html("Update Comment");
    $('html, body').animate({
        scrollTop: $(".card-body").offset().top
    }, 1000);
}

function deleteComment(blogId,commentId) {
    var _token = $("#_token").val();
   if (confirm("Are you sure to delete your comment??")){
       $.post("/admin/deleteComment",{blogId:blogId,_token:_token,commentId:commentId},function (response) {
           if (response.deleted == '1'){
               getCommentsById(blogId);
           }
       });
   }
}



function doLikeDislike(blogId,action) {

    var _token = $("#_token").val();
    $.post("/admin/doLikeDislike",{blogId:blogId,_token:_token,action:action},function (response) {
        var actionPerformed = response.action;
        var again = response.again;

        if (actionPerformed == 'like' && again == 'firstLike' ){
            $('#likeBtn'+blogId).css('color','red');
            $('#dislikeBtn'+blogId).css('color','');
        }else if (actionPerformed == 'like' && again == 'againLike'){
            $('#likeBtn'+blogId).css('color','');
            $('#dislikeBtn'+blogId).css('color','');
        } else  if (actionPerformed == 'dislike' && again == 'firstDislike' ){
            $('#dislikeBtn'+blogId).css('color','red');
            $('#likeBtn'+blogId).css('color','');
        }else  if (actionPerformed == 'dislike' && again == 'againDislike' ){
            $('#dislikeBtn'+blogId).css('color','');
            $('#likeBtn'+blogId).css('color','');
        }

        $('#likeCountLabel'+blogId).html(response.likeCount);
        $('#dislikeCountLabel'+blogId).html(response.disLikeCount);

    });

}



