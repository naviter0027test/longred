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
        <div class="search-panel">
            <form action="/account/record" method="post" enctype="multipart/form-data" class="">
                <h4>狀態設定</h4>
                <select name="checkStatus">
                    <option value="">全部</option>
                    <option value="處理中">處理中</option>
                    <option value="待核准">待核准</option>
                    <option value="核准">核准</option>
                    <option value="取消申辦">取消申辦</option>
                    <option value="婉拒">婉拒</option>
                </select>
                <h4>關鍵字搜尋</h4>
                <input type="text" name="keyword" />
            </form>
            <h3 class="tag tag-hover">近一個月</h3><h3 class="tag">近三個月</h3>
            <table>
                <thead>
                    <tr>
                        <td>進件日期</td>
                        <td>申請人ID</td>
                        <td>商品名稱</td>
                        <td>案件狀態</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2020-01-02</td>
                        <td>A123456789</td>
                        <td>AAA</td>
                        <td>待核准</td>
                    </tr>
                </tbody>
            </table>
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
    <script src="/js/front/search.js"></script>
</html>
