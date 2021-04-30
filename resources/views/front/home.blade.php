<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/front/body.css' rel='stylesheet' />
    </head>
    <body class="body">
        <div class="header">
            借貸 APP 展示
        </div>
        <p class="sec-bar"> 經銷商分期 </p>
        <div class="content">
            <div class="item">
                <a class="item-a" href="/front/create">
                    <div class="img glyphicon glyphicon-plus"></div>
                    <div class="desc">進件</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/search">
                    <div class="img glyphicon glyphicon-search"></div>
                    <div class="desc">案件查詢</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/appropriation">
                    <div class="img glyphicon glyphicon-euro"></div>
                    <div class="desc">撥款查詢</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/process">
                    <div class="img glyphicon glyphicon-play-circle"></div>
                    <div class="desc">處理中</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/wait">
                    <div class="img glyphicon glyphicon-pause"></div>
                    <div class="desc">待核准</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/agree">
                    <div class="img glyphicon glyphicon-ok"></div>
                    <div class="desc">核准</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/degree">
                    <div class="img glyphicon glyphicon-trash"></div>
                    <div class="desc">婉拒</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/cancel">
                    <div class="img glyphicon glyphicon-remove"></div>
                    <div class="desc">取消申辦</div>
                </a>
            </div>
            <div class="item">
                <a class="item-a" href="/front/news">
                    <div class="img glyphicon glyphicon-globe"></div>
                    <div class="desc">最新消息</div>
                </a>
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
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-messaging.js"></script>
    <script src="/js/front/home.js"></script>
    <script src="/js/front/firebase-use.js"></script>
</html>
