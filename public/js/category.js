$(document).ready(function(){
  $(document).ready(function() {
    /* Progress Bar animation */
    $(".progress-bar").animate({
        width: "100%"
    }, 100 ); // start in under a sec
});
    $("#loading").fadeOut(2000,function(){
        $("body").css("overflow","auto");
    })
   
})
$(document).ready(function() {
  $(".skitter-large").skitter({
    theme : 'square',
    navigation : true,
    dots: false,
    show_randomly: true,
    with_animations: ["paralell", "glassBlock", "swapBars"],
  });   
});

var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null,    // optional scroll container selector, otherwise use window,
    resetAnimation: true,     // reset animation on end (default is true)
  }
);
wow.init();


$(".sub-image .sub-img").click(function(){
    var src = $(this).attr("src");
    $(this).parent().parent().parent().parent().parent().find(".main-img").attr("src",src);
})

 












