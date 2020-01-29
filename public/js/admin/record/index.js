$(document).ready(function() {
    $('.recordRemove').on('click', function() {
        if(confirm('確定刪除') == false) {
            console.log('no');
            return false;
        }
    });

    $('.importBtn').on('click', function() {
        $('[name=importCSV]').trigger('click');
        return false;
    });

    $('[name=importCSV]').on('change', function() {
        $('.importForm').submit();
    });
});
