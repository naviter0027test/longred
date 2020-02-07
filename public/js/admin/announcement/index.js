$(document).ready(function() {
    $('.table1 .del').on('click', function() {
        if(confirm('是否刪除?') == false) {
            console.log('cancel');
            return false;
        }
    });
});

