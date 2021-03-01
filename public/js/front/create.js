$(document).ready(function() {
    $('.create-form').submit(function() {
        var postData = $(this).serialize();
        var href = $(this).attr('action');
        $(this).ajaxSubmit(function(resData) {
            console.log(resData);
            var resJson = resData;
            if(resJson['status'] == true) {
                alert('送出成功');
                location.href = "/front/home";
            }
            else {
                alert('送出失敗');
            }
        });
        return false;
    });
});
