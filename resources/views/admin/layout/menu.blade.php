<div class="admin-bar">
    <span>長鴻系統</span>
    <div class="tool-right">
        <a href="/admin/logout">登出</a>
    </div>
</div>

<div class="admin-menu">
    <div class="menu1">
        <a href="/admin/home" class="{{ strpos(\Request::path(), 'admin/home') === false ? '' : 'clicked' }} glyphicon glyphicon-bell">
        通知中心</a>
    </div>
    <div class="menu1">
        <a href="/admin/setting" class="{{ strpos(\Request::path(), 'admin/setting') === false ? '' : 'clicked' }} glyphicon glyphicon-lock">
        密碼更改</a>
    </div>
    <div class="menu1">
        <a href="/admin/record" class="{{ strpos(\Request::path(), 'admin/record') === false ? '' : 'clicked' }} glyphicon glyphicon-th-list">
        案件查詢</a>
    </div>
    <div class="menu1">
        <a href="/admin/grant" class="{{ strpos(\Request::path(), 'admin/grant') === false ? '' : 'clicked' }} glyphicon glyphicon-eur">
        撥款查詢</a>
    </div>
    <div class="menu1">
        <a href="/admin/account" class="{{ strpos(\Request::path(), 'admin/account') === false ? '' : 'clicked' }} glyphicon glyphicon-user">
        使用者管理</a>
    </div>
    <div class="menu1">
        <a href="/admin/news" class="{{ strpos(\Request::path(), 'admin/news') === false ? '' : 'clicked' }} glyphicon glyphicon-envelope">
        消息管理</a>
    </div>
    <div class="menu1">
        <a href="/admin/announcement" class="{{ strpos(\Request::path(), 'admin/announcement') === false ? '' : 'clicked' }} glyphicon glyphicon-bookmark">
        公告管理</a>
    </div>
</div>
