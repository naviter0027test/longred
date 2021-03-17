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
            撥款明細
        </div>
        <p class="sec-bar"> 經銷商分期 </p>
        <div class="create-content">
            <form action="/application/update" method="post" enctype="multipart/form-data" class="login-form create-form">
                <p>
                    <h4>申請人姓名</h4>
                    <input type="text" name="applicant" readonly />
                </p>
                <p>
                    <h4>身份證字號</h4>
                    <input type="text" name="CustGID" readonly />
                </p>
                <p>
                    <h4>案件狀態</h4>
                    <input type="text" name="checkStatus" readonly />
                </p>
                <p>
                    <h4>申貸金額/期數/期付款</h4>
                    <input type="text" name="applyData" readonly />
                </p>
                <p>
                    <h4>準駁日期</h4>
                    <input type="text" name="allowDate" readonly />
                </p>
                <p>
                    <h4>商品名稱</h4>
                    <input type="text" name="productName" readonly />
                </p>
                <p>
                    <h4>批單內容</h4>
                    <input type="text" name="content" readonly />
                </p>
                <p>
                    <h4>撥款狀態</h4>
                    <input type="text" name="schedule" readonly />
                </p>
                <p>
                    <h4>撥款金額</h4>
                    <input type="text" name="grantAmount" readonly />
                </p>
                <p>
                    <h4>撥款日期</h4>
                    <input type="text" name="grantDate" readonly />
                </p>
                <p>
                    <h4>動產設定</h4>
                    <input type="text" name="ProjectCategory" readonly />
                </p>
                <p>
                    <h4>車牌號碼</h4>
                    <input type="text" name="liense" readonly />
                </p>
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
    <script src="/js/front/record.js"></script>
</html>
