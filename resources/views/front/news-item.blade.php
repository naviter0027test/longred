<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/front/body.css' rel='stylesheet' />
        <link href='/css/front/news.css' rel='stylesheet' />
    </head>
    <body class="body">
        <div class="header">
            最新消息
            <a href="/front/news" class="glyphicon glyphicon-bell bell"><label>0</label></a>
        </div>
        <div class="news-panel">
            <div class="news-item">
                <h6>2020-09-04 12:00:00</h6>
                <h4>[案件留言與回覆]</h4>
            </div>
            <div class="news-content">
ksadjflasjdflksajdfl;
            </div>
        </div>
        <div class="logout">
            <a href="/account/logout">登出帳號</a>
        </div>
        <div class="footer">
            若有任何問題，請洽客服00-00000000
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery.form.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-messaging.js"></script>
    <script src="/lib/jquery.form.js"></script>
    <script src="/js/front/firebase-use.js"></script>
    <script src="/js/front/home.js"></script>
    <script src="/js/front/news-item.js"></script>
</html>
