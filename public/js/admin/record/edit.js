function getRecordMessages() {
    var recordId = $('.form1').attr('recordId');
    new Promise(function(resolve, reject) {
        $.get('/admin/message/record/'+recordId, function(result) {
            resolve(result);
        });
    }).then(function(result) {
        result1 = JSON.parse(result);
        console.log(result1);
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
});
