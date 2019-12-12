<html>
    <head>
        <meta charset="utf-8">
        <title>長鴻管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/admin/body.css' rel='stylesheet' />
    </head>
    <body>
        <div class="admin-bar">
            <span>長鴻系統</span>
            <div class="tool-right">
                <a href="/admin/logout">登出</a>
            </div>
        </div>
        <div class="admin-menu">
            <div class="menu1">
                <a href="/admin/home" class="clicked glyphicon glyphicon-bell">
                通知中心</a>
            </div>
            <div class="menu1">
                <a href="/admin/setting" class="glyphicon glyphicon-lock">
                密碼更改</a>
            </div>
            <div class="menu1">
                <a href="/admin/record" class="glyphicon glyphicon-th-list">
                案件查詢</a>
            </div>
            <div class="menu1">
                <a href="/admin/grant" class="glyphicon glyphicon-eur">
                撥款查詢</a>
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
