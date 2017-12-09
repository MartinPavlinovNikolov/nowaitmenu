$(document).ready(function () {
    $('.btn-employer').on('click', function (e) {
        e.preventDefault();
        $('.btn-employer').off();
        $(this).parent().children('.table-modal-employees').css('display', 'block');
    });
    $('.close-table-employees').on('click', function (e) {
        $(this).parent().parent().css('display', 'none');
        $('.btn-employer').on('click', function (e) {
        e.preventDefault();
        $('.btn-employer').off();
        $(this).parent().children('.table-modal-employees').css('display', 'block');
    });
    });
});