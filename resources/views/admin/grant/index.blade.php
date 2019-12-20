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
            <h3>撥款查詢</h3>
            <table class="table1">
                <thead>
                    <tr>
                        <td>身份證</td>
                        <td>申請人姓名</td>
                        <td>商品名稱</td>
                        <td>撥款金額</td>
                        <td>撥款日期</td>
                        <td>撥款狀態</td>
                        <td>建立日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($result['records'] as $record)
                    <tr>
                        <td>{{ $record->CustGID }}</td>
                        <td>{{ $record->applicant }}</td>
                        <td>{{ $record->productName }}</td>
                        <td>{{ $record->grantAmount }}</td>
                        <td>{{ $record->grantDate }}</td>
                        <td>{{ $record->schedule }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>
                            <a href='/admin/record/edit/{{ $record->id }}' class="glyphicon glyphicon-pencil"></a>
                            <a href='/admin/record/remove/{{ $record->id }}' class="glyphicon glyphicon-remove"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination paginationCenter">
            @for($i = 0; $i < ceil($result['amount'] / $offset); ++$i)
                @if(($i+1) == $nowPage)
                <label>{{ $i+1 }}</label>
                @elseif(($i+1) != $nowPage)
                <a href="/admin/record/?nowPage={{ $i+1 }}">{{ $i+1 }}</a>
                @endif
            @endfor
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
