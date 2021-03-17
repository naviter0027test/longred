$(document).ready(function() {
    var clickRecordId = window.sessionStorage.getItem('clickRecordId');
    var postData = {
        'recordId' : clickRecordId
    };
    $.post('/account/message/record-id', postData, function(data) {
        var json = JSON.parse(data);
        console.log(json);
        if(json['result'] == true) {
            $('.message-content').html('');
            json['data'].forEach(function(record, idx) {
                switch(record['isAsk']) {
                    case "1":
                        $('.message-content').append('<div class="message-me"> <h5>我:</h5> <div>'+ record['content']+ '</div> </div>');
                        break;
                    case "2":
                        $('.message-content').append('<div class="message-admin"> <h5>管理者:</h5> <div>'+ record['content']+ '</div> </div>');
                        break;
                }
            });
        }
    });
});
