function processing() {
    $('body').append("<div style='position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);width: 20rem;height: 10rem;background-color: #7d7574c9;border: 2px solid blue'><div class='text-center' style='color: white;font-size: 2rem;padding:0;margin:0 auto;'>Processing</div><div class='loader'></div></div>");
}
$(document).ready(function () {
    $('.btn-employer').on('click', function (e) {
        e.preventDefault();
        $('.btn-employer').off();
        $(this).parent().children('.table-modal-employees').css('display', 'block');
    });
    $('.close-table-employees').on('click', function (e) {
        $(this).parent().css('display', 'none');
        $('.btn-employer').on('click', function (e) {
            e.preventDefault();
            $('.btn-employer').off();
            $(this).parent().children('.table-modal-employees').css('display', 'block');
        });
    });
    $('body').on('click', '.process', function (e) {
        setTimeout(processing(), 800);
    });
    $('body').on('click', '.if-process', function (e) {
        if ($('#search').val().length > 0) {
            setTimeout(processing(), 800);
        }
    });
});