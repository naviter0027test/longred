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
        <form class="login-form" method="post" action="/account/forget">
            <p class="login-input">
                <i class="glyphicon glyphicon-envelope"></i><input type="text" name="email" /> 
            </p>
            <p> <button class="btn login-submit">發送</button> </p>
        </form>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/front/forget.js"></script>
</html>
