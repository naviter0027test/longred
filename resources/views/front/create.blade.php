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
        <div class="create-content">
            <form action="#" method="post" enctype="multipart/form-data">
            <p>
                <h4>申請人姓名</h4>
                <input type="text" name="applicant" />
            </p>
            <p>
                <h4>身份證字號</h4>
                <input type="text" name="CustGID" />
            </p>
            <p>
                <h4>申貸金額</h4>
                <input type="text" name="applyAmount" />
            </p>
            <p>
                <h4>身份證照片 正面</h4>
                <input type="file" name="CustGIDPicture1" />
            </p>
            <p>
                <h4>身份證照片 反面</h4>
                <input type="file" name="CustGIDPicture2" />
            </p>
            <p>
                <h4>商品名稱</h4>
                <input type="text" name="productName" />
            </p>
            <p>
                <h4>車牌號碼</h4>
                <input type="text" name="liense" />
            </p>
            <p>
                <h4>申請文件</h4>
                <input type="file" name="applyUploadPath" />
            </p>
            <p>
                <h4>財產證明</h4>
                <input type="file" name="proofOfProperty" />
            </p>
            <p>
                <h4>其他</h4>
                <input type="file" name="otherDoc[]" />
                <input type="file" name="otherDoc[]" />
                <input type="file" name="otherDoc[]" />
                <input type="file" name="otherDoc[]" />
                <input type="file" name="otherDoc[]" />
                <input type="file" name="otherDoc[]" />
            </p>
        </div>
        <div class="logout">
            <a href="/account/logout">登出帳號</a>
        </div>
        <div class="footer">
            若有任何問題，請洽客服00-00000000
        </div>
    </body>
</html>
