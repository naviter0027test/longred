$(document).ready(function() {
    $.get("/account/isLogin", function(resData) {
        var resJson = JSON.parse(resData);
        if(resJson['status'] == false)
            location.href = "/front/login";
    });

    $('.logout').on('click', function() {
        if(confirm('確定登出?')) {
            var href = $(this).attr('href');
            $.get('/account/logout', function(resData) {
                console.log(resData);
                var resJson = JSON.parse(resData);
                if(resJson['status'] == true) {
                    alert('登出成功');
                    location.href = "/front/login";
                }
            });
        }
        return false;
    });
});
