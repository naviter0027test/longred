<div class="admin-bar">
    <span>長鴻系統</span>
    <div class="tool-right">
        <a href="/admin/logout">登出</a>
    </div>
</div>

<div class="admin-menu">
    <div class="menu1">
        <a href="/admin/home" class="{{ strpos('admin/home', \Request::path()) === false ? '' : 'clicked' }} glyphicon glyphicon-bell">
        通知中心</a>
    </div>
    <div class="menu1">
        <a href="/admin/setting" class="{{ strpos('admin/setting', \Request::path()) === false ? '' : 'clicked' }} glyphicon glyphicon-lock">
        密碼更改</a>
    </div>
    <div class="menu1">
        <a href="/admin/record" class="{{ strpos('admin/record', \Request::path()) === false ? '' : 'clicked' }} glyphicon glyphicon-th-list">
        案件查詢</a>
    </div>
    <div class="menu1">
        <a href="/admin/grant" class="{{ strpos('admin/grant', \Request::path()) === false ? '' : 'clicked' }} glyphicon glyphicon-eur">
        撥款查詢</a>
    </div>
</div>
