<html>
    <head>
        <meta charset="utf-8">
        <title>長鴻系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/web/body.css' rel='stylesheet' />
    </head>
    <body>
        <div class="content">
            <h3>設定apple token API模擬頁面</h3>
            <form method='post' action='/account/apple-token/set' class='form1' enctype="multipart/form-data">
                <h5>apple-token</h5>
                <p> 
                    <input type="text" name="appleToken" value="" />
                </p>
                <h5>token mode (1: ios, 2: android)</h5>
                <p> 
                    <input type="text" name="tokenMode" value="1" />
                </p>
                <p class=""> <button class="btn">設定</button> </p>
            </form>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
