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
            <h3>案件查詢</h3>
            <div class="nav">
                <form method="post" action="/admin/record/import" enctype="multipart/form-data" class="importForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="file" name="importCSV" class="importCSV" />
                </form>
                <form method="get" action="/admin/record" class="searchBar">
                    案件狀態
                    <select name="checkStatus">
                        <option value=""  >請選擇</option>
                        <option value="處理中"  {{ isset($params['checkStatus']) && $params['checkStatus'] == "處理中" ? 'selected="selected"' : '' }}  >處理中</option>
                        <option value="待核准"  {{ isset($params['checkStatus']) && $params['checkStatus'] == "待核准" ? 'selected="selected"' : '' }}  >待核准</option>
                        <option value="核准"    {{ isset($params['checkStatus']) && $params['checkStatus'] == "核准" ? 'selected="selected"' : '' }}    >核准</option>
                        <option value="取消申辦" {{ isset($params['checkStatus']) && $params['checkStatus'] == "取消申辦" ? 'selected="selected"' : '' }}>取消申辦</option>
                        <option value="婉拒"    {{ isset($params['checkStatus']) && $params['checkStatus'] == "婉拒" ? 'selected="selected"' : '' }}    >婉拒</option>
                    </select>
                    撥款狀態
                    <select name="schedule">
                        <option value=""  >請選擇</option>
                        <option value="核准"  {{ isset($params['schedule']) && $params['schedule'] == "核准" ? 'selected="selected"' : '' }} >核准</option>
                        <option value="已撥款"  {{ isset($params['schedule']) && $params['schedule'] == "已撥款" ? 'selected="selected"' : '' }} >已撥款</option>
                    </select>
                    進件日期區間
                    <input type="date" name="startDate" value="{{ isset($params['startDate']) ? $params['startDate'] : '' }}" />
                    ~
                    <input type="date" name="endDate" value="{{ isset($params['endDate']) ? $params['endDate'] : '' }}" />
                    <br />
                    <input type="text" name="keyword" placeholder="關鍵字查詢" value="{{ isset($params['keyword']) ? $params['keyword'] : '' }}" />
                    <input type="text" name="dealer" placeholder="經銷商" value="{{ isset($params['dealer']) ? $params['dealer'] : '' }}" />
                    <button class="btn">查詢</button>
                </form>
                <a href="#" class="importBtn btn">
                    CSV 匯入
                </a>
            </div>
            <table class="table1">
                <thead>
                    <tr>
                        <td>身份證</td>
                        <td>申請人姓名</td>
                        <td>案件狀態</td>
                        <td>準駁日期</td>
                        <td>商品名稱</td>
                        <td>申貸金額</td>
                        <td>建立日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @if(isset($result['records']))
                @foreach($result['records'] as $record)
                    <tr>
                        <td>{{ $record->CustGID }}</td>
                        <td>{{ $record->applicant }}</td>
                        <td>{{ $record->checkStatus }}</td>
                        <td>{{ $record->allowDate }}</td>
                        <td>{{ $record->productName }}</td>
                        <td>{{ $record->applyAmount }}</td>
                        <td>{{ $record->created_at }}</td>
                        <td>
                            <a href='/admin/record/edit/{{ $record->id }}' class="glyphicon glyphicon-pencil"></a>
                            <a href='/admin/record/remove/{{ $record->id }}' class="glyphicon glyphicon-remove recordRemove"></a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>

            <div class="pagination paginationCenter">
            @if(isset($result['amount']))
            @for($i = 0; $i < ceil($result['amount'] / $offset); ++$i)
                @if(($i+1) == $nowPage)
                <label>{{ $i+1 }}</label>
                @elseif(($i+1) != $nowPage && abs($i+1-$nowPage) < 5)
                <a href="/admin/record/?nowPage={{ $i+1 }}&{{ http_build_query($params) }}">{{ $i+1 }}</a>
                @endif
            @endfor
            @endif
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/admin/record/index.js"></script>
</html>

