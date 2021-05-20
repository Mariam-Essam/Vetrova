$(window).scroll(function(){
   var x = $(window).scrollTop();
    if (x>900)
        {$(".upButton").fadeIn(600);}
    else{$(".upButton").fadeOut(600);}
});
$(".upButton").click(function(){
    $("body").animate({scrollTop:0},1000)
})


$(".arrow-down").click(function(){
    $(this).parent().parent().next().find("table").slideToggle(200);
    $(this).find(".rotate").toggleClass("up");
});
