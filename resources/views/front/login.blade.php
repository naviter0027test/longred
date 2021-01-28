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
        <div class="login-header">
            借貸 APP 展示
        </div>
        <p class="sec-bar"> -- </p>
        <form class="login-form" method="post" action="/account/login">
            <input type="hidden" name="appleToken" />
            <p class="login-input">
                <i class="glyphicon glyphicon-user"></i><input type="text" name="account" /> 
            </p>
            <p class="login-input">
                <i class="glyphicon glyphicon-lock"></i><input type="password" name="password" />
            </p>
            <p> <button class="btn login-submit">登入</button> </p>
            <p class="login-forget"> <a href="/front/forget">忘記密碼</a> </p>
        </form>
    </body>
</html>
