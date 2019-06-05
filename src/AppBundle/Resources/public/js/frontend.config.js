$(function(){
    $('.nav-link').hover(function(){
        $(this).addClass('active');
    },function(){
        $(this).removeClass('active');
    });

    $('.product-description img').css({"width":"100%","height":"auto"});
    $("#main img").css({"width":"100%","height":"auto"});

});