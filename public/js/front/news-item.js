$(document).ready(function() {
    var messages = window.sessionStorage.getItem("messages");
    var messageId = window.sessionStorage.getItem("message-id");
    messagesList = JSON.parse(messages);
    messagesList['data'].forEach(function(news, idx) {
        if(news['id'] == messageId) {
            $('.news-item h6').text(news['created_at']);
            $('.news-item h4').text(news['title']);
            $('.news-content').text(news['content']);

            var postData = {
                messageId : messageId
            };
            $.post('/account/message/read', postData, function(data) {
                console.log(data);
                getNotReadableAmount()
            });
        }
    });
});
