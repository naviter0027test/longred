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
        $('[name=applicant]').val(recordNow['applicant']);
        $('[name=CustGID]').val(recordNow['CustGID']);
        $('[name=checkStatus]').val(recordNow['checkStatus']);
        $('[name=applyData]').val(recordNow['applyAmount']+'/'+recordNow['periods']+'/'+recordNow['periodAmount']);
        $('[name=allowDate]').val(recordNow['allowDate']);
        $('[name=productName]').val(recordNow['productName']);
        $('[name=content]').val(recordNow['content']);
        $('[name=schedule]').val(recordNow['schedule']);
        $('[name=grantAmount]').val(recordNow['grantAmount']);
        $('[name=grantDate]').val(recordNow['grantDate']);
        $('[name=ProjectCategory]').val(recordNow['ProjectCategory']);
        $('[name=liense]').val(recordNow['liense']);
    }
});
