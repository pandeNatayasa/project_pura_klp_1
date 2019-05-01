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

    $("#sidebar-nav").click(function(){
        $(".sidebar-wrapper").show()
    })

    $('button.mapstyles').click(function(e) {
        e.preventDefault();
        $('button').removeClass('active');
        $(this).addClass('active');
    });
});