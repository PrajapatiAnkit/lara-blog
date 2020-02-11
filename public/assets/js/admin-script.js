
/*
 baseUrl is comming from the script include from page
 */

$("form#adminLogin").on("submit",function (e) {
    e.preventDefault();
    var userName = $("#userName").val();
    var userPassword = $("#userPassword").val();
    var _token = $("#_token").val();

    var formAction = $("#adminLogin").attr("action");
    $.post(formAction, {
            userName:userName,userPassword:userPassword,_token:_token},
        function (response) {
        alert(response);
    });
});
