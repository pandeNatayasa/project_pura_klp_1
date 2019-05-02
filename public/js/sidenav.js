$(document).ready(function(){
    $("#close-element,.element").click(function(){
        $("#myElement").animate({
        width: "toggle"
        });
        $("#myElement2").hide()
    });

    $("#close-element2,.element2").click(function(){
        $("#myElement").hide()
        $("#myElement2").animate({
        width: "toggle"
        });
    });


    $("#close-sidebar").click(function() {
        $(".sidebar-wrapper").hide();
        $('#myElement').hide();
    });

    $("#close-sidebar-menu").click(function() {
        $("#sidebar-option").animate({
            width: "toggle"
        });
    });


    $("#sidebar-nav").click(function(){
        $("#sidebar-option").animate({
            width: "toggle"
        });
    });
    $('button.mapstyles').click(function(e) {
        e.preventDefault();
        $('button').removeClass('active');
        $(this).addClass('active');
    });

    setTimeout(function() {
    $('#sidebar')
        .removeClass('loading')
        .addClass('loaded')
    }, 3000);
});