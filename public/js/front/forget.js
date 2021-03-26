$(document).ready(function() {
    $('.login-form').submit(function() {
        var postData = $(this).serialize();
        var href = $(this).attr('action');
        $.post(href, postData, function(resData) {
            console.log(resData);
            var resJson = resData;
            if(resJson['status'] == true) {
                alert(resJson['msg']);
                location.href = "/front/home";
            }
            else
                alert(resJson['msg']);
        });
        return false;
    });
});
