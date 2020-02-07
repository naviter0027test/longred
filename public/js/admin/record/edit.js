function getRecordMessages() {
    var recordId = $('.form1').attr('recordId');
    new Promise(function(resolve, reject) {
        $.get('/admin/message/record/'+recordId, function(result) {
            resolve(result);
        });
    }).then(function(result) {
        result1 = JSON.parse(result);
        var data = result1.data;
        $('.leaveMsgDiv').html('');
        for(var i = 0; i < data.length;++i) {
            if(data[i]['isAsk'] == 1) {
                $('.leaveMsgDiv').append('<h5>申請者:</h5>');
                $('.leaveMsgDiv').append('<p>'+ data[i]['content']+ '</p>');
            } else {
                $('.leaveMsgDiv').append('<h5>管理者:</h5>');
                $('.leaveMsgDiv').append('<p>'+ data[i]['content']+ '</p>');
            }
        }
        setTimeout(getRecordMessages, 1000);
    });
}
$(document).ready(function() {
    setTimeout(getRecordMessages, 1000);
    $('.replyMsg').on('submit', function() {
        var serialize = $(this).serialize();
        $.post('/admin/message/send', serialize, function(result) {
            var result1 = JSON.parse(result);
            console.log(result1);
            $('.replyMsg [name=content]').val('');
            if(result1['result'] == true) {
                alert('回覆成功');
            } else {
                alert('回覆失敗');
                console.log(result1);
            }
        });
        return false;
    });
});
