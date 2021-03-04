function formatDate(d) {
    var month = '' + (d.getMonth() + 1);
    var day = '' + d.getDate();
    var year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function showTable(jsonData) {
    $('.search-result tbody').html('');
    jsonData['records'].forEach(function(record, idx) {
        var tr = document.createElement('tr');
        $(tr).append("<td>"+ record['created_at'] +"</td>");
        $(tr).append("<td>"+ record['CustGID'] +"</td>");
        $(tr).append("<td>"+ record['productName'] +"</td>");
        $(tr).append("<td>"+ record['checkStatus'] +"</td>");
        $('.search-result tbody').append(tr);
    });
}

function getRecord(postData) {
    var action = $('.search-form').attr('action');
    $.post(action, postData, function(data) {
        var jsonData = JSON.parse(data);
        console.log(jsonData);
        $('.search-result tbody').html('');
        if(jsonData['result'] == true) {
            showTable(jsonData);
        }
        else
            alert(jsonData['msg']);
    });
}

function initSearch() {
    var monthAgo = new Date();
    monthAgo.setMonth(monthAgo.getMonth() - 1);
    var monthAgoDate = formatDate(monthAgo);
    var checkStatus = $('[name=checkStatus]').val();
    var nowDate = formatDate(new Date());
    var postData = {
        'startDate': monthAgoDate,
        'endDate': nowDate,
        'checkStatus': checkStatus,
        'nowPage': 1,
        'offset': 9999
    };
    getRecord(postData);
}

$(document).ready(function() {
    initSearch();

    $('[name=checkStatus]').on('change', function() {
        var checkStatus = $('[name=checkStatus]').val();
        var keyword = $('[name=keyword]').val();
        var nowDate = formatDate(new Date());
        var searchData = {
            'endDate': nowDate,
            'checkStatus': checkStatus,
            'keyword': keyword,
            'nowPage': 1,
            'offset': 9999
        };
        var monthAgo = new Date();
        monthAgo.setMonth(monthAgo.getMonth() - 1);
        var monthAgoDate = formatDate(monthAgo);
        searchData['startDate'] = monthAgoDate;
        if($('.three-month').hasClass('tag-hover')) {
            var monthAgo = new Date();
            monthAgo.setMonth(monthAgo.getMonth() - 3);
            var monthAgoDate = formatDate(monthAgo);
            searchData['startDate'] = monthAgoDate;
        }
        getRecord(searchData);
    });

    $('[name=keyword]').on('keyup', function() {
        var checkStatus = $('[name=checkStatus]').val();
        var keyword = $('[name=keyword]').val();
        var nowDate = formatDate(new Date());
        var searchData = {
            'endDate': nowDate,
            'checkStatus': checkStatus,
            'keyword': keyword,
            'nowPage': 1,
            'offset': 9999
        };
        var monthAgo = new Date();
        monthAgo.setMonth(monthAgo.getMonth() - 1);
        var monthAgoDate = formatDate(monthAgo);
        searchData['startDate'] = monthAgoDate;
        if($('.three-month').hasClass('tag-hover')) {
            var monthAgo = new Date();
            monthAgo.setMonth(monthAgo.getMonth() - 3);
            var monthAgoDate = formatDate(monthAgo);
            searchData['startDate'] = monthAgoDate;
        }
        getRecord(searchData);
    });

    $('.tag').on('click', function() {
        $('.tag').removeClass('tag-hover');
        $(this).addClass('tag-hover');
        var checkStatus = $('[name=checkStatus]').val();
        var keyword = $('[name=keyword]').val();
        var nowDate = formatDate(new Date());
        var postData = {
            'endDate': nowDate,
            'checkStatus': checkStatus,
            'keyword': keyword,
            'nowPage': 1,
            'offset': 9999
        };
        if($(this).hasClass('one-month')) {
            var monthAgo = new Date();
            monthAgo.setMonth(monthAgo.getMonth() - 1);
            var monthAgoDate = formatDate(monthAgo);
            postData['startDate'] = monthAgoDate;
        }
        else {
            var monthAgo = new Date();
            monthAgo.setMonth(monthAgo.getMonth() - 3);
            var monthAgoDate = formatDate(monthAgo);
            postData['startDate'] = monthAgoDate;
        }
        getRecord(postData);
    });
});
