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
            <h3>使用者 - 編輯</h3>
            @if($result['result'] == false)
            {{ $result['msg'] }}
            @else
            <form method='post' action='/admin/account/edit/{{ $result['account']->id }}' class='form1' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>帳號</h5>
                <p> <input type="text" name="account" value="{{ $result['account']->account }}" required /> </p>
                <h5>密碼</h5>
                <p> <input type="password" name="password" /> </p>
                <h5>名稱</h5>
                <p> <input type="text" name="name" value="{{ $result['account']->name }}" /> </p>
                <h5>Email</h5>
                <p> <input type="text" name="email" value="{{ $result['account']->email }}" /> </p>
                <h5>手機</h5>
                <p> <input type="text" name="phone" value="{{ $result['account']->phone }}" /> </p>
                <h5>區域</h5>
                <p> <input type="text" name="area" value="{{ $result['account']->area }}" /> </p>
                <h5>權限</h5>
                <p> <input type="text" name="permission" value="{{ $result['account']->permission }}" /> </p>
                <h5>狀態</h5>
                <p>
                    <select name="active">
                        <option value="0" {{ $result['account']->active == 0 ? 'selected' : '' }} >未啟用</option>
                        <option value="1" {{ $result['account']->active == 1 ? 'selected' : '' }} >啟用</option>
                    </select>
                </p>
                <p class=""> <button class="btn">編輯</button> </p>
            </form>
            @endif
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/lib/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="/lib/jquery-validation/dist/localization/messages_zh_TW.min.js"></script>
    <script src="/js/admin/account/edit.js"></script>
</html>
