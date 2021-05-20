let acceptedOffset = $(".accepted").offset().top;
$(window).scroll(function(){
   var x = $(window).scrollTop(); 
    if (x>900)
        {$(".upButton").fadeIn(600);}
    else{$(".upButton").fadeOut(600);}
});

$(".upButton").click(function(){
    $("body").animate({scrollTop:0},1000)
})

$(".navbar a").click(function(){
    var href = $(this).attr("href");
    let offset = $(href).offset().top+1;
    $("body").animate({scrollTop:offset},500);
    /*.pendding,.accepted,.refused,.approved,.disapproved*/
    if(href == "#pendding")
        {
            $(".pend").css({color:"#333",borderBottom:"3px solid #333"});
            $(".accept").css({color:"#333",borderBottom:"none"})
            $(".refuse").css({color:"#333",borderBottom:"none"})
            $(".approve").css({color:"#333",borderBottom:"none"})
            $(".disapprove").css({color:"#333",border:"none"})
            $(".pendding").show();
            $(".accepted").hide();
            $(".refused").hide();
            $(".approved").hide();
            $(".disapproved").hide();
        }
    if(href == "#accepted")
        {
            $(".pend").css({color:"#333",borderBottom:"none"});
            $(".accept").css({color:"#333",borderBottom:"3px solid #333"})
            $(".refuse").css({color:"#333",borderBottom:"none"})
            $(".approve").css({color:"#333",borderBottom:"none"})
            $(".disapprove").css({color:"#333",border:"none"})
            $(".pendding").hide();
            $(".accepted").show();
            $(".refused").hide();
            $(".approved").hide();
            $(".disapproved").hide();
        }
    if(href == "#refused")
        {
            $(".pend").css({color:"#333",borderBottom:"none"});
            $(".accept").css({color:"#333",border:"none"})
            $(".refuse").css({color:"#333",borderBottom:"3px solid #333"})
            $(".approve").css({color:"#333",borderBottom:"none"})
            $(".disapprove").css({color:"#333",border:"none"})
            $(".pendding").hide();
            $(".accepted").hide();
            $(".refused").show();
            $(".approved").hide();
            $(".disapproved").hide();
        }
    if(href == "#approved")
        {
            $(".pend").css({color:"#333",borderBottom:"none"});
            $(".accept").css({color:"#333",border:"none"})
            $(".refuse").css({color:"#333",borderBottom:"none"})
            $(".approve").css({color:"#333",borderBottom:"3px solid #333"})
            $(".disapprove").css({color:"#333",border:"none"})
            $(".pendding").hide();
            $(".accepted").hide();
            $(".refused").hide();
            $(".approved").show();
            $(".disapproved").hide();
        }
    if(href == "#disapproved")
        {
            $(".pend").css({color:"#333",borderBottom:"none"});
            $(".accept").css({color:"#333",border:"none"})
            $(".refuse").css({color:"#333",borderBottom:"none"})
            $(".approve").css({color:"#333",borderBottom:"none"})
            $(".disapprove").css({color:"#333",borderBottom:"3px solid #333"})
            $(".pendding").hide();
            $(".accepted").hide();
            $(".refused").hide();
            $(".approved").hide();
            $(".disapproved").show();
        }
})
