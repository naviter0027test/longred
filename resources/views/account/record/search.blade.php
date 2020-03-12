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
            <h3>查詢案件API模擬頁面</h3>
            <form method='post' action='/account/record' class='form1' enctype="multipart/form-data">
                <h5>案件狀態</h5>
                <p> 
                    <select name="checkStatus" > 
                        <option value=""></option>
                        <option value="處理中">處理中</option>
                        <option value="待核准">待核准</option>
                        <option value="核准">核准</option>
                        <option value="取消申辦">取消申辦</option>
                        <option value="婉拒">婉拒</option>
                    </select>
                </p>
                <h5>撥款狀態</h5>
                <p> 
                    <select name="schedule" > 
                        <option value=""></option>
                        <option value="核准">核准</option>
                        <option value="已撥款">已撥款</option>
                    </select>
                </p>
                <h5>進件日期區間</h5>
                <p> 
                    <input type="date" name="startDate" value="" />
                    ~
                    <input type="date" name="endDate" value="" />
                </p>
                <h5>關鍵字查詢</h5>
                <p>
                    <input type="text" name="keyword" placeholder="關鍵字查詢" value="" />
                </p>
                <h5>經銷商</h5>
                <p>
                    <input type="text" name="dealer" placeholder="經銷商" value="" />
                </p>
                <h5>第幾頁</h5>
                <p>
                    <input type="number" name="nowPage" value="1" />
                </p>
                <h5>一頁顯示數量</h5>
                <p>
                    <input type="number" name="offset" value="10" />
                </p>
                <p class=""> <button class="btn">查詢</button> </p>
            </form>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>

