<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/front/body.css' rel='stylesheet' />
        <link href='/css/front/message.css' rel='stylesheet' />
    </head>
    <body class="body">
        <div class="header">
            留言查看
            <a href="/front/news" class="glyphicon glyphicon-bell bell"><label>0</label></a>
        </div>
        <p class="sec-bar"> -- </p>
        <div class="message-content">
            <div class="message-me">
                <h5>我:</h5>
                <div>test</div>
            </div>
            <div class="message-admin">
                <h5>管理者:</h5>
                <div>test</div>
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
    <script src="/js/front/firebase-use.js"></script>
    <script src="/js/front/home.js"></script>
    <script src="/js/front/message.js"></script>
</html>
