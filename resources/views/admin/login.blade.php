<html>
    <head>
        <meta charset="utf-8">
        <title>長鴻管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/admin/body.css' rel='stylesheet' />
        <link href='/css/admin/login.css' rel='stylesheet' />
    </head>
    <body>
        <div class="loginDiv">
            <h3 class="companyName">長鴻管理系統</h3>
            <!--<form class="loginForm" method="post" action="/admin/login">-->
            <form class="loginForm" method="get" action="/admin/home">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>帳號:</h5>
                <p> <input type="text" name="account" /> </p>
                <h5>密碼:</h5>
                <p> <input type="password" name="password" /> </p>
                <p class="loginBtnP"> <button class="btn loginSubmit">登入</button> </p>
            </form>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/admin/login.js"></script>
</html>
