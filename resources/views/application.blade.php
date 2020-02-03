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
            <h3>新增案件API模擬頁面</h3>
            <form method='post' action='/application/create' class='form1' enctype="multipart/form-data">
                <h5>身份證字號(必填)</h5>
                <p> <input type="text" name="CustGID" /> </p>
                <h5>申請人姓名(必填)</h5>
                <p> <input type="text" name="applicant" /> </p>
                <h5>申貸金額(必填)</h5>
                <p> <input type="text" name="applyAmount" /> </p>
                <h5>身份證照片 正面 </h5>
                <p>
                    <input type="file" name="CustGIDPicture1" /> </p>
                <h5>身份證照片 反面 </h5>
                <p>
                    <input type="file" name="CustGIDPicture2" />
                </p>
                <h5>商品名稱</h5>
                <p> <input type="text" name="productName" /> </p>
                <h5>車牌號碼</h5>
                <p> <input type="text" name="liense" /> </p>
                <h5>申請文件 </h5>
                <p>
                    <input type="file" name="applyUploadPath" />
                </p>
                <h5>財產證明 </h5>
                <p>
                    <input type="file" name="proofOfProperty" />
                </p>
                <h5>其他 </h5>
                <p>
                    <input type="file" name="otherDoc" />
                </p>
                <h5>備註</h5>
                <p> <input type="text" name="memo" /> </p>
                <p class=""> <button class="btn">申請</button> </p>
            </form>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
