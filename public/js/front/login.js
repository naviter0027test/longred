$(document).ready(function() {
    $.get("/account/isLogin", function(resData) {
        var resJson = JSON.parse(resData);
        if(resJson['status'] == true)
            location.href = "/front/home";
    });

    $('.login-form').submit(function() {
        var postData = $(this).serialize();
        var href = $(this).attr('action');
        $.post("/account/login", postData, function(resData) {
            console.log(resData);
            var resJson = JSON.parse(resData);
            if(resJson['status'] == true) {
                alert('登入成功');
                location.href = "/front/home";
            }
            else
                alert('帳密有誤');
        });
        return false;
    });
});
