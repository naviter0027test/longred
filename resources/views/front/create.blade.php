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
            進件
        </div>
        <p class="sec-bar"> 經銷商分期 </p>
        <div class="create-content">
            <form action="/application/create" method="post" enctype="multipart/form-data" class="login-form create-form">
            <p>
                <h4>申請人姓名</h4>
                <input type="text" name="applicant" required />
            </p>
            <p>
                <h4>身份證字號</h4>
                <input type="text" name="CustGID" required />
            </p>
            <p>
                <h4>申貸金額</h4>
                <input type="text" name="applyAmount" required />
            </p>
            <p>
                <h4>身份證照片 正面</h4>
                <input type="file" name="CustGIDPicture1" required />
            </p>
            <p>
                <h4>身份證照片 反面</h4>
                <input type="file" name="CustGIDPicture2" required />
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
                <input type="file" name="applyUploadPath" required />
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
            <button class="btn login-submit">送出</button>
            </form>
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
    <script src="/js/front/home.js"></script>
    <script src="/js/front/create.js"></script>
</html>
