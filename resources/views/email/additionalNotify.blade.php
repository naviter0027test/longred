<html>
    <head>
        <title>補件通知信件</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h3>系統通知：</h3>
        <p>有案件有以下欄位補件，可點擊此<a href={{url($link)}}>連結</a>前往查看</p>
        <ul>
        @if($notify['CustGIDPicture1'] == true)
            <li> 身份證照片正面 </li>
        @endif
        @if($notify['CustGIDPicture2'] == true)
            <li> 身份證照片反面 </li>
        @endif
        @if($notify['applyUploadPath'] == true)
            <li> 申請文件 </li>
        @endif
        @if($notify['proofOfProperty'] == true)
            <li> 財力證明 </li>
        @endif
        @if($notify['otherDoc'] == true)
            <li> 其他文件1 </li>
        @endif
        @if($notify['otherDoc2'] == true)
            <li> 其他文件2 </li>
        @endif
        @if($notify['otherDoc3'] == true)
            <li> 其他文件3 </li>
        @endif
        @if($notify['otherDoc4'] == true)
            <li> 其他文件4 </li>
        @endif
        @if($notify['otherDoc5'] == true)
            <li> 其他文件5 </li>
        @endif
        @if($notify['otherDoc6'] == true)
            <li> 其他文件6 </li>
        @endif
    </body>
</html>
