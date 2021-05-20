$(window).scroll(function(){
    var x = $(window).scrollTop();
if (x>1)
    {$(".upButton").fadeIn(100);}
    else
    {$(".upButton").fadeOut(100);}
});
$(".upButton").click(function(){
    $("body").animate({scrollTop:0},1000)
})
$(".small-images .img-small .small-img").click(function(){
    var src=$(this).attr("src");
    $(".big-image .img-big .big-img").attr("src",src);
})
var path1 = $(".small-img1").attr("src");
var path2 = $(".small-img2").attr("src");
var path3 = $(".small-img3").attr("src");

var paths = [path1, path2, path3];
$(".next").click(function(){
    var big_src=$(".big-image .img-big .big-img").attr("src");
    console.log(big_src);
    for(var i=0; i<paths.length; i++){
        if(big_src == paths[i]){
            console.log("kkmknj");
            m=(i+1)%paths.length;
           $(".big-image .img-big .big-img").attr("src" , paths[m]);
        }
    }
})


$(".prev").click(function(){
    var bigSrc = $(".big-image .img-big .big-img").attr("src");
    for(var j=0; j<paths.length; j++){
        if(bigSrc == paths[j]){
            k=(j+1)%paths.length;
           $(".big-image .img-big .big-img").attr("src",paths[k]);
        }
    }
})

$(".love-react").click(function(){
    $(".love-react").css({backgroundColor:"#2C566A"})
    $(".like-react").css({backgroundColor:"transparent"})
    $(".dislike-react").css({backgroundColor:"transparent"})
})

$(".like-react").click(function(){
    $(".like-react").css({backgroundColor:"#2C566A"})
    $(".love-react").css({backgroundColor:"transparent"})
    $(".dislike-react").css({backgroundColor:"transparent"})
})

$(".dislike-react").click(function(){
    $(".dislike-react").css({backgroundColor:"#2C566A"})
    $(".love-react").css({backgroundColor:"transparent"})
    $(".like-react").css({backgroundColor:"transparent"})
})


$("#small").click(function(){
    $(".small-info").toggle(1000);
})
$("#medium").click(function(){
    $(".medium-info").toggle(1000);
})
$("#large").click(function(){
    $(".large-info").toggle(1000);
})
$("#x-large").click(function(){
    $(".xlarge-info").toggle(1000);
})
$("#xx-large").click(function(){
    $(".xxlarge-info").toggle(1000);
})
$("#more").click(function(){
    $(".moresize-info").toggle(1000);
})
/*********************************************small******************************************/
$("#small-red").click(function(){
    $(".small-red-num").toggle(1000);
})
$("#small-blue").click(function(){
    $(".small-blue-num").toggle(1000);
})
$("#small-black").click(function(){
    $(".small-black-num").toggle(1000);
})


/*********************************************medium******************************************/
$("#medium-red").click(function(){
    $(".medium-red-num").toggle(1000);
})
$("#medium-blue").click(function(){
    $(".medium-blue-num").toggle(1000);
})
$("#medium-black").click(function(){
    $(".medium-black-num").toggle(1000);
})



/*********************************************large******************************************/
$("#large-red").click(function(){
    $(".large-red-num").toggle(1000);
})
$("#large-blue").click(function(){
    $(".large-blue-num").toggle(1000);
})
$("#large-black").click(function(){
    $(".large-black-num").toggle(1000);
})
/*********************************************xlarge******************************************/
$("#xlarge-red").click(function(){
    $(".xlarge-red-num").toggle(1000);
})
$("#xlarge-blue").click(function(){
    $(".xlarge-blue-num").toggle(1000);
})
$("#xlarge-black").click(function(){
    $(".xlarge-black-num").toggle(1000);
})
/*********************************************xxlarge******************************************/
$("#xxlarge-red").click(function(){
    $(".xxlarge-red-num").toggle(1000);
})
$("#xxlarge-blue").click(function(){
    $(".xxlarge-blue-num").toggle(1000);
})
$("#xxlarge-black").click(function(){
    $(".xxlarge-black-num").toggle(1000);
})
/*********************************************more******************************************/
$("#more-red").click(function(){
    $(".more-red-num").toggle(1000);
})
$("#more-blue").click(function(){
    $(".more-blue-num").toggle(1000);
})
$("#more-black").click(function(){
    $(".more-black-num").toggle(1000);
})







