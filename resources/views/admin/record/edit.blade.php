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
            <h3>案件查詢 - 明細</h3>
            @if($result['result'] == false) 
            {{ $result['msg'] }}
            @else
            <form method='post' action='/admin/record/edit/{{ $result['record']->id }}' recordId="{{ $result['record']->id }}" class='form1' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>身份證字號</h5>
                <p> <input type="text" name="CustGID" value="{{ $result['record']->CustGID }}" /> </p>
                <h5>申請人姓名</h5>
                <p> <input type="text" name="applicant" value="{{ $result['record']->applicant }}" /> </p>
                <h5>案件狀態</h5>
                <p>
                    <select name="checkStatus">
                        <option value="處理中"  {{ $result['record']->checkStatus == '處理中' ? 'selected="selected"' : '' }} >處理中  </option>
                        <option value="待核准"  {{ $result['record']->checkStatus == '待核准' ? 'selected="selected"' : '' }} >待核准  </option>
                        <option value="核准"    {{ $result['record']->checkStatus == '核准' ? 'selected="selected"' : '' }} >核准    </option>
                        <option value="取消申辦" {{ $result['record']->checkStatus == '取消申辦' ? 'selected="selected"' : '' }} >取消申辦</option>
                        <option value="婉拒"    {{ $result['record']->checkStatus == '婉拒' ? 'selected="selected"' : '' }} >婉拒    </option>
                    </select>
                </p>
                <h5>身份證照片 正面 </h5>
                <p>
                @if($result['record']->CustGIDPicture1 != '')
                    <img src="/uploads{{ $result['record']->CustGIDPicture1 }}" class="custPic" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="CustGIDPicture1" /> </p>
                <h5>身份證照片 反面 </h5>
                <p>
                @if($result['record']->CustGIDPicture2 != '')
                    <img src="/uploads{{ $result['record']->CustGIDPicture2 }}" class="custPic" /> <br />
                @else
                    無<br />
                @endif
                <!--
                    <img src="https://www.ris.gov.tw/apply-idCard/resources/images/newid2-1.jpg" class="custPic" /> <br />
                -->
                    補件如下:
                    <input type="file" name="CustGIDPicture2" />
                </p>
                <h5>申請書 </h5>
                <p>
                @if($result['record']->applyUploadPath != '')
                    <img src="/uploads{{ $result['record']->applyUploadPath }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="applyUploadPath" />
                </p>
                <h5>財力證明 </h5>
                <p>
                @if($result['record']->proofOfProperty != '')
                    <img src="/uploads{{ $result['record']->proofOfProperty }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="proofOfProperty" />
                </p>
                <h5>其他文件1 </h5>
                <p>
                @if($result['record']->otherDoc != '')
                    <img src="/uploads{{ $result['record']->otherDoc }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>其他文件2 </h5>
                <p>
                @if($result['record']->otherDoc2 != '')
                    <img src="/uploads{{ $result['record']->otherDoc2 }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>其他文件3 </h5>
                <p>
                @if($result['record']->otherDoc3 != '')
                    <img src="/uploads{{ $result['record']->otherDoc3 }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>其他文件4 </h5>
                <p>
                @if($result['record']->otherDoc4 != '')
                    <img src="/uploads{{ $result['record']->otherDoc4 }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>其他文件5 </h5>
                <p>
                @if($result['record']->otherDoc5 != '')
                    <img src="/uploads{{ $result['record']->otherDoc5 }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>其他文件6 </h5>
                <p>
                @if($result['record']->otherDoc6 != '')
                    <img src="/uploads{{ $result['record']->otherDoc6 }}" /> <br />
                @else
                    無<br />
                @endif
                    補件如下:
                    <input type="file" name="otherDoc[]" />
                </p>
                <h5>經辦廠商</h5>
                <p> <input type="text" name="inCharge" value="{{ $result['record']->inCharge }}" /> </p>
                <h5>準駁日期</h5>
                <p> <input type="date" name="allowDate" value="{{ $result['record']->allowDateVal }}" /> </p>
                <h5>商品名稱</h5>
                <p> <input type="text" name="productName" value="{{ $result['record']->productName }}" /> </p>
                <h5>申貸金額</h5>
                <p> <input type="text" name="applyAmount" value="{{ $result['record']->applyAmount }}" /> </p>
                <h5>核貸金額</h5>
                <p> <input type="text" name="loanAmount" value="{{ $result['record']->loanAmount }}" /> </p>
                <h5>核准期數</h5>
                <p> <input type="number" name="periods" value="{{ $result['record']->periods }}" /> </p>
                <h5>期付金額</h5>
                <p> <input type="text" name="periodAmount" value="{{ $result['record']->periodAmount }}" /> </p>
                <h5>批單內容</h5>
                <p> <textarea type="text" name="content" >{{ $result['record']->content }}</textarea> </p>
                <h5>撥款狀態</h5>
                <p>
                    <select name="schedule">
                        <option value="核准" {{ $result['record']->schedule == '核准' ? 'selected="selected"' : '' }} >核准</option>
                        <option value="已撥款"   {{ $result['record']->schedule == '已撥款' ? 'selected="selected"' : '' }} >已撥款</option>
                    </select>
                </p>
                <h5>撥款日期</h5>
                <p> <input type="date" name="grantDate" value="{{ $result['record']->grantDateVal }}" /> </p>
                <h5>撥款金額</h5>
                <p> <input type="text" name="grantAmount" value="{{ $result['record']->grantAmount }}" /> </p>
                <h5>車牌號碼</h5>
                <p> <input type="text" name="liense" value="{{ $result['record']->liense }}" /> </p>
                <p class=""> <button class="btn">更改</button> </p>
            </form>

            <div class="leaveMessage">
                <h4>留言</h4>
                <div class="leaveMsgDiv">
                    <h5>申請者:</h5>
                    <p> 這究得飛料民了然興何？腦見著作需益黃我出手岸 </p>
                    <h5>管理者:</h5>
                    <p> 積門當應各手的如的使美起有麼在生中個在 </p>
                </div>
                <form action="/admin/message/send" method="post" class="replyMsg">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="recordId" value="{{ $result['record']->id }}" />
                    <p class=""> <textarea name="content"></textarea> </p>
                    <p class=""> <button class="btn">回覆</button> </p>
                </form>
            </div>
            @endif
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/admin/record/edit.js"></script>
</html>
