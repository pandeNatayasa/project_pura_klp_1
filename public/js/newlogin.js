$(document).ready(function(){
    $('.card-active').click(function(e) {
        e.preventDefault();
        $('.card-active').removeClass('active');
        $(this).addClass('active');
    });
})