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
            <h3>消息管理</h3>
            <div class="nav">
                <a href="/admin/news/create" class="btn">
                    新增
                </a>
            </div>
            <table class="table1">
                <thead>
                    <tr>
                        <td>內容</td>
                        <td>建立日期</td>
                        <td>修改日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($result['news'] as $item)
                    <tr>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href='/admin/news/edit/{{ $item->id }}' class="glyphicon glyphicon-pencil"></a>
                            <a href='/admin/news/remove/{{ $item->id }}' class="glyphicon glyphicon-remove del"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination paginationCenter">
            @for($i = 0; $i < ceil($result['amount'] / $offset); ++$i)
                @if(($i+1) == $nowPage)
                <label>{{ $i+1 }}</label>
                @elseif(($i+1) != $nowPage && abs($i+1-$nowPage) < 5)
                <a href="/admin/news/?nowPage={{ $i+1 }}">{{ $i+1 }}</a>
                @endif
            @endfor
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/admin/news/index.js"></script>
</html>
