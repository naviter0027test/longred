$(document).ready(function() {
    var postData = {
        'nowPage': 0,
        'offset': 9999,
    };
    $.get('/account/message', postData, function(res) {
        window.sessionStorage.setItem("messages", res);
        var jsonData = JSON.parse(res);
        console.log(jsonData);
        if(jsonData['result'] == true) {
            $('.news-panel').html('');
            jsonData['data'].forEach(function(news, idx) {
                var newsText = 
                    '<a href="/front/news-id/'+ news.id+ '" news-id="'+ news.id+ '" class="news-item">'
                    + '<h6>'+ news.created_at+ '</h6>';
                if(news.isRead == 0)
                    newsText += '<h4><b>'+ news.title+ '</b></h4>';
                else
                    newsText += '<h4>'+ news.title+ '</h4>';
                newsText += '<span class="news-right-arrow glyphicon glyphicon-chevron-right"></span>'
                    + '</a>';
                $('.news-panel').append(newsText);
            });
            $('.news-item').on('click', function() {
                window.sessionStorage.setItem("message-id", $(this).attr('news-id'));
            });
        }
    });
});
