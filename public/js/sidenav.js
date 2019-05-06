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
        $(".sidebar-wrapper").animate({
            width: "0"
        });
        $('#myElement').hide();
    });

    $("#close-floating-area").click(function() {
        $("#show-floating-area").show();
        $(".floating-area").animate({
            width: "toggle"
        });;
      });

      $("#show-floating-area").click(function() {
        $("#show-floating-area").hide();
        $(".floating-area").animate({
            width: "toggle"
        });;
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

    $("#myPano").pano({
        img: "/user_img/element/panorama.jpg"
    });

});