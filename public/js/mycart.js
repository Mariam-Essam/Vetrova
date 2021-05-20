/*part1
cart-dot
prev-cart
shopping-cart/*/
$(".part1").click(function(){
    $(".shopping-cart").show(1000);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").hide(900);
})
$(".cart-dot").click(function(){
    $(".shopping-cart").show(1000);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").hide(900);
})
$("#prev-cart").click(function(){
    $(".shopping-cart").show(1000);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").hide(900);
})

/*part2
shipping-dot
prev-shipping
next-shipping
shipping*/
$(".part2").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").show(1000);
    $(".payment").hide(900);
    $("#finish").hide(900);
    $(".shipping-dot:before").css({backgroundColor:"#333"})
})
$(".shipping-dot").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").show(1000);
    $(".payment").hide(900);
    $("#finish").hide(900);
    $(".shipping-dot:before").css({backgroundColor:"#333"})
})
$("#prev-shipping").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").show(1000);
    $(".payment").hide(900);
    $("#finish").hide(900);
    $(".shipping-dot:before").css({backgroundColor:"#333"})
})
$("#next-shipping").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").show(1000);
    $(".payment").hide(900);
    $("#finish").hide(900);
})


/*part3
payment-dot
next-payment
prev-payment
payment*/
$(".part3").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").show(1000);
    $("#finish").hide();
})
$(".payment-dot").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").show(1000);
    $("#finish").hide(900);
})
$("#next-payment").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").show(1000);
    $("#finish").hide(900);
})
$("#prev-payment").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").show(1000);
    $("#finish").hide(900);
})

/*part4
finish-dot
next-finish
finish*/
$(".part4").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").show(1000);
})
$(".finish-dot").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").show(1000);
})
$("#next-finish").click(function(){
    $(".shopping-cart").hide(900);
    $(".shipping").hide(900);
    $(".payment").hide(900);
    $("#finish").show(1000);
})

$("#payment-paypal").click(function(){
    $(".paypal-info").show(1000);
    $(".fawry-info").hide(1000);
})
$("#payment-fawry").click(function(){
    $(".paypal-info").hide(1000);
    $(".fawry-info").show(1000);
})
$("#payment-cash").click(function(){
    $(".paypal-info").hide(1000);
    $(".fawry-info").hide(1000);
})












