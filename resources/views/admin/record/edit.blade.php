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
            <form method='post' action='/admin/record/edit' class='form1' enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>身份證字號</h5>
                <p> <input type="text" name="CustGID" /> </p>
                <h5>申請人姓名</h5>
                <p> <input type="text" name="applicant" /> </p>
                <h5>案件狀態</h5>
                <p>
                    <select name="checkStatus">
                        <option value="處理中"  >處理中  </option>
                        <option value="待核准"  >待核准  </option>
                        <option value="核准"    >核准    </option>
                        <option value="取消申辦">取消申辦</option>
                        <option value="婉拒"    >婉拒    </option>
                    </select>
                </p>
                <h5>身份證照片 正面 </h5>
                <p>
                    <img src="https://upload.wikimedia.org/wikipedia/zh/1/1e/ROC_ID_2005_specimen_front.jpg" class="custPic" /> <br />
                    補件如下:
                    <input type="file" name="CustGIDPicture1" /> </p>
                <h5>身份證照片 反面 </h5>
                <p>
                    <img src="https://www.ris.gov.tw/apply-idCard/resources/images/newid2-1.jpg" class="custPic" /> <br />
                    補件如下:
                    <input type="file" name="CustGIDPicture2" />
                </p>
                <h5>經辦廠商</h5>
                <p> <input type="text" name="inCharge" /> </p>
                <h5>準駁日期</h5>
                <p> <input type="date" name="allowDate" /> </p>
                <h5>商品名稱</h5>
                <p> <input type="text" name="productName" /> </p>
                <h5>申貸金額</h5>
                <p> <input type="text" name="applyAmount" /> </p>
                <h5>核貸金額</h5>
                <p> <input type="text" name="loanAmount" /> </p>
                <h5>核准期數</h5>
                <p> <input type="number" name="periods" /> </p>
                <h5>期付金額</h5>
                <p> <input type="text" name="periodAmount" /> </p>
                <h5>批單內容</h5>
                <p> <textarea type="text" name="content" ></textarea> </p>
                <h5>撥款狀態</h5>
                <p>
                    <select name="schedule">
                        <option value="尚未撥款"  >尚未撥款</option>
                        <option value="已撥款"    >已撥款</option>
                        <option value="支票已出"  >支票已出</option>
                    </select>
                </p>
                <h5>撥款日期</h5>
                <p> <input type="date" name="grantDate" /> </p>
                <h5>撥款金額</h5>
                <p> <input type="text" name="grantAmount" /> </p>
                <h5>車牌號碼</h5>
                <p> <input type="text" name="liense" /> </p>
                <p class=""> <button class="btn">更改</button> </p>
            </form>

            <div class="leaveMessage">
                <h4>留言</h4>
                <h5>申請者:</h5>
                <p> 這究得飛料民了然興何？腦見著作需益黃我出手岸 </p>
                <h5>管理者:</h5>
                <p> 積門當應各手的如的使美起有麼在生中個在 </p>
                <form action="/admin/message/reply" method="post">
                    <p class=""> <textarea name="replyMsg"></textarea> </p>
                    <p class=""> <button class="btn">回覆</button> </p>
                </form>
            </div>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
</html>
