$(document).ready(function() {
    $('.create-form').submit(function() {
        $.blockUI();
        var postData = $(this).serialize();
        var href = $(this).attr('action');
        $(this).ajaxSubmit(function(resData) {
            $.unblockUI();
            console.log(resData);
            var resJson = resData;
            if(resJson['status'] == true) {
                alert('送出成功');
                location.href = "/front/home";
            }
            else {
                alert('送出失敗:'+resJson['message']);
            }
        });
        return false;
    });
});
