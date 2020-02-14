<html>
    <head>
        <meta charset="utf-8">
        <title>長鴻管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/admin/body.css' rel='stylesheet' />
    </head>
    <body>
@include('admin.layout.menu')
        <div class="content">
            <h3>公告 - 編輯</h3>
            @if($result['result'] == false)
            {{ $result['msg'] }}
            @else
            <form method='post' action='/admin/announcement/edit/{{ $result['announcement']->id }}' class='form1' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>標題</h5>
                <p> <input type="text" name="title" value="{{ $result['announcement']->title }}" required /> </p>
                <h5>內容</h5>
                <p> <textarea name="content" required >{{ $result['announcement']->content }}</textarea> </p>
                <p class=""> <button class="btn">編輯</button> </p>
            </form>
            @endif
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/lib/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="/lib/jquery-validation/dist/localization/messages_zh_TW.min.js"></script>
    <script src="/js/admin/announcement/edit.js"></script>
</html>
