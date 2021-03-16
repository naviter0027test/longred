<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/front/body.css' rel='stylesheet' />
        <link href='/css/front/search.css' rel='stylesheet' />
    </head>
    <body class="body">
        <div class="header">
            案件查詢
        </div>
        <p class="sec-bar"> 經銷商分期 </p>
        <div class="search-panel">
            <form action="/account/record" method="post" enctype="multipart/form-data" class="search-form">
                <h4>狀態設定</h4>
                <select name="checkStatus">
                    <option value="">全部</option>
                    <option value="處理中" {{ $data['checkStatus'] == "處理中" ? 'selected' : '' }}>處理中</option>
                    <option value="待核准" {{ $data['checkStatus'] == "待核准" ? 'selected' : '' }}>待核准</option>
                    <option value="核准" {{ $data['checkStatus'] == "核准" ? 'selected' : '' }}>核准</option>
                    <option value="取消申辦" {{ $data['checkStatus'] == "取消申辦" ? 'selected' : '' }}>取消申辦</option>
                    <option value="婉拒" {{ $data['checkStatus'] == "婉拒" ? 'selected' : '' }}>婉拒</option>
                </select>
                <h4>關鍵字搜尋</h4>
                <input type="text" name="keyword" />
            </form>
            <h3 class="tag one-month tag-hover">近一個月</h3><h3 class="tag three-month">近三個月</h3>
            <table class="search-result">
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
