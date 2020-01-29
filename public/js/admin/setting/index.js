$(document).ready(function() {
    $('.form1').validate({
        rules: {
            passwordOld: "required",
            password: "required",
            passwordConfirm: 
            {
                required: true,
                equalTo: "#password"
            }
        }
    });
});
