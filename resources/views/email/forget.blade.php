<html>
    <head>
        <title>忘記密碼信件</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h3>Hi! {{ $account->name }}</h3>
        <p>收到忘記密碼的請求，以下為您的新密碼</p>
        <p>您的新密碼: {{ $password }}</p>
    </body>
</html>

