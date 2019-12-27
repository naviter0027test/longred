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
            <h3>使用者管理</h3>
            <div class="nav">
                <a href="/admin/account/create" class="btn">
                    新增
                </a>
            </div>
            <table class="table1">
                <thead>
                    <tr>
                        <td>帳號</td>
                        <td>名稱</td>
                        <td>手機</td>
                        <td>Email</td>
                        <td>建立日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($result['accounts'] as $account)
                    <tr>
                        <td>{{ $account->account }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->phone }}</td>
                        <td>{{ $account->email }}</td>
                        <td>{{ $account->created_at }}</td>
                        <td>
                            <a href='/admin/account/edit/{{ $account->id }}' class="glyphicon glyphicon-pencil"></a>
                            <a href='/admin/account/remove/{{ $account->id }}' class="glyphicon glyphicon-remove"></a>
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
                <a href="/admin/grant/?nowPage={{ $i+1 }}">{{ $i+1 }}</a>
                @endif
            @endfor
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>

