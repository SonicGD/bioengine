$(function () {
    $('.form-control').phoenix();
    $('form').on('beforeSubmit', function (e) {
        $('.form-control').phoenix('remove');
    })
});