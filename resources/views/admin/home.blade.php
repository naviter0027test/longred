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
            <h3>通知中心</h3>
            @foreach($result['data'] as $message)
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">{{ $message->dateShow }}</span>
                <span class="cls">
                    [{{ $message->typeShow }}]
                @if(in_array($message->type, [3, 4, 5]))
                    <a href="/admin/record/edit/{{ $message->recordId }}">前往查看</a>
                @endif
                </span>
                @if($message->type == 3)
                    @if($message->isAsk == 1)
                <span class="notify-content">使用者:{{ $message->titleShow }}</span>
                    @elseif($message->isAsk == 2)
                <span class="notify-content">管理者:{{ $message->titleShow }}</span>
                    @endif
                @elseif($message->type != 3)
                <span class="notify-content">{{ $message->titleShow }}</span>
                @endif
            </div>
            @endforeach
            <div class="pagination paginationCenter">
            @if(isset($result['amount']))
            @for($i = 0; $i < ceil($result['amount'] / $result['offset']); ++$i)
                @if(($i+1) == $result['nowPage'])
                <label>{{ $i+1 }}</label>
                @elseif(($i+1) != $result['nowPage'] && abs($i+1-$result['nowPage']) < 5)
                <a href="/admin/home/?nowPage={{ $i+1 }}">{{ $i+1 }}</a>
                @endif
            @endfor
            @endif
            </div>
<!--
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">2019-08-02</span>
                <span class="notify-content">這究得飛料民了然興何？腦見著作需益黃我出手岸電喜維行四展是地生條來農交眾商農大越示動十有。路望受式的可以走或經次裡、積門當應各手的如的使美起有麼在生中個在。</span>
            </div>
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">2019-08-02</span>
                <span class="notify-content">這究得飛料民了然興何？腦見著作需益黃我出手岸電喜維行四展是地生條來農交眾商農大越示動十有。路望受式的可以走或經次裡、積門當應各手的如的使美起有麼在生中個在。</span>
            </div>
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">2019-08-02</span>
                <span class="notify-content">這究得飛料民了然興何？腦見著作需益黃我出手岸電喜維行四展是地生條來農交眾商農大越示動十有。路望受式的可以走或經次裡、積門當應各手的如的使美起有麼在生中個在。</span>
            </div>
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">2019-08-02</span>
                <span class="notify-content">這究得飛料民了然興何？腦見著作需益黃我出手岸電喜維行四展是地生條來農交眾商農大越示動十有。路望受式的可以走或經次裡、積門當應各手的如的使美起有麼在生中個在。</span>
            </div>
            <div class="notify">
                <i class="glyphicon glyphicon-bell" ></i>
                <span class="date">2019-08-02</span>
                <span class="notify-content">這究得飛料民了然興何？腦見著作需益黃我出手岸電喜維行四展是地生條來農交眾商農大越示動十有。路望受式的可以走或經次裡、積門當應各手的如的使美起有麼在生中個在。</span>
            </div>
-->
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
