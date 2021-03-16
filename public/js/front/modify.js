$(document).ready(function() {
    var recordList = JSON.parse(window.sessionStorage.getItem('recordList'));
    var clickRecordId = window.sessionStorage.getItem('clickRecordId');
    var recordNow = null;
    recordList['records'].forEach(function(record, idx) {
        if(record['id'] == clickRecordId) {
            recordNow = record;
            return;
        }
    });
    console.log(recordNow);
    if(recordNow == null)
        alert('指定資料不存在');
    else {
        $('[name=id]').val(recordNow['id']);
        $('[name=applicant]').val(recordNow['applicant']);
        $('[name=CustGID]').val(recordNow['CustGID']);
        $('[name=applyAmount]').val(recordNow['applyAmount']);
        if(recordNow['CustGIDPicture1'].trim() != '') {
            $('[name=CustGIDPicture1]').after("<img src='/uploads"+ recordNow['CustGIDPicture1']+ "' />");
        }
        if(recordNow['CustGIDPicture2'].trim() != '') {
            $('[name=CustGIDPicture2]').after("<img src='/uploads"+ recordNow['CustGIDPicture2']+ "' />");
        }
        $('[name=productName]').val(recordNow['productName']);
        $('[name=liense]').val(recordNow['liense']);
        if(recordNow['applyUploadPath'].trim() != '') {
            $('[name=applyUploadPath]').after("<img src='/uploads"+ recordNow['applyUploadPath']+ "' />");
        }
        if(recordNow['otherDoc'].trim() != '') {
            $($('[name="otherDoc[]"]')[0]).after("<img src='/uploads"+ recordNow['otherDoc']+ "' />");
        }
        if(recordNow['otherDoc2'].trim() != '') {
            $($('[name="otherDoc[]"]')[1]).after("<img src='/uploads"+ recordNow['otherDoc2']+ "' />");
        }
        if(recordNow['otherDoc3'].trim() != '') {
            $($('[name="otherDoc[]"]')[2]).after("<img src='/uploads"+ recordNow['otherDoc3']+ "' />");
        }
        if(recordNow['otherDoc4'].trim() != '') {
            $($('[name="otherDoc[]"]')[3]).after("<img src='/uploads"+ recordNow['otherDoc4']+ "' />");
        }
        if(recordNow['otherDoc5'].trim() != '') {
            $($('[name="otherDoc[]"]')[4]).after("<img src='/uploads"+ recordNow['otherDoc5']+ "' />");
        }
        if(recordNow['otherDoc6'].trim() != '') {
            $($('[name="otherDoc[]"]')[5]).after("<img src='/uploads"+ recordNow['otherDoc6']+ "' />");
        }
    }
});
