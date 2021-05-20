/////////////////////////////////owl carousel//////////////////////////////////
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
      margin:0,
      loop:true,
      center:true,
      autoplay:true,
      autoplayTimeout:2000,
      items:3,
      center:true,
  });
});
////////////////////////////////skitter-slider//////////////////////////////
$(document).ready(function() {
  $(".skitter-large").skitter({
    dots: true,
    show_randomly: true,
    with_animations: ["paralell", "glassBlock", "swapBars"],
     width_skitter: 1350,
      responsive: {
	    small: {
	      max_width: 1360
	    },
	    medium: {
	      max_width: 1360
	    },
        large:{
           max_width: 1360 
        }}
  });   
    $('.box_skitter_large').skitter({
        width_skitter: 1350
    })
});

///////////////////////////woooooow/////////////////////////////
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

//////////////////////upButtonClick///////////////////////////////////
$(".upButton").click(function(){
    $("body").animate({scrollTop:0},1000)
})

 ////////////////////////////////navbar/////////////////////////////////////
$(window).scroll(function(){
    var x = $(window).scrollTop();

/////////////////////////when scrolling at home///////////////////////
    if(x >=0 && x < $(".categories").offset().top){
        $(".h").css({color:"#333",borderBottom:"3px solid #333"});
        $(".cat").css({color:"#333",border:"none"})
        $(".top-d").css({color:"#333",borderBottom:"none"})
        $(".top-p").css({color:"#333",borderBottom:"none"})
        $(".serv").css({color:"#333",borderBottom:"none"})
        
        $(".navbar").css({position:"static",backgroundColor:"#fff"}) ;
        $(".nav-link").css({color:"#333"})
        }
    
/////////////////////////when scrolling at actegories///////////////////////    
    else if(x >= $(".categories").offset().top && x < $(".top-designers").offset().top){
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"3px solid #fff"})
        $(".top-d").css({color:"#fff",borderBottom:"none"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"none"})
    }
    
/////////////////////////when scrolling at top-designers///////////////////////
    else if(x >= $(".top-designers").offset().top && x < $(".top-products").offset().top){
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"none"})
        $(".top-d").css({color:"#fff",borderBottom:"3px solid #fff"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"none"})
    }
    
/////////////////////////when scrolling at top-products///////////////////////
    else if(x >= $(".top-products").offset().top && x < $(".services").offset().top){
            $(".h").css({color:"#fff",borderBottom:"none"});
            $(".cat").css({color:"#fff",borderBottom:"none"})
            $(".top-d").css({color:"#fff",borderBottom:"none"})
            $(".top-p").css({color:"#fff",borderBottom:"3px solid #fff"})
            $(".serv").css({color:"#fff",borderBottom:"none"})
        }
    
 /////////////////////////when scrolling at services or the rest of the page///////////////////////   
    else{
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"none"})
        $(".top-d").css({color:"#fff",borderBottom:"none"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"3px solid #fff"})
}
//////////////////////////////when we back to the top of page//////////////////////
    if(x>=$(".categories").offset().top){
        $(".navbar").css({backgroundColor:"rgba(44, 86, 106, 0.8)", transition:"all 0.5s",position:"fixed",top:"0",right:"0",left:"0",zIndex:"100"});
        $(".nav-link").css({color:"#fff"})}
    
    else{
        $(".navbar").css({position:"static",backgroundColor:"#fff"}) ;
        $(".nav-link").css({color:"#333"})}
    
    /////////////////////////upButtonShowing//////////////////////
    if (x>590)
    {$(".upButton").fadeIn(300);}

    else
    {$(".upButton").fadeOut(300);}
});


////////////////////when reloading///////////////////////////    
function scrolling(){
    var x = $(window).scrollTop();
    ////////////////////////////navbar showing////////////////////////
    if(x >=0 && x < $(".categories").offset().top){
        $(".h").css({color:"#333",borderBottom:"3px solid #333"});
        $(".cat").css({color:"#333",border:"none"})
        $(".top-d").css({color:"#333",borderBottom:"none"})
        $(".top-p").css({color:"#333",borderBottom:"none"})
        $(".serv").css({color:"#333",borderBottom:"none"})
        
        $(".navbar").css({position:"static",backgroundColor:"#fff"}) ;
        $(".nav-link").css({color:"#333"})
        }
    
/////////////////when we reload in home section/////////////////////
    else if(x >= $(".categories").offset().top && x < $(".top-designers").offset().top){
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"3px solid #fff"})
        $(".top-d").css({color:"#fff",borderBottom:"none"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"none"})
    }
    
/////////////////when we reload in categories section/////////////////////
    else if($(window).scrollTop() >= $(".categories").offset().top && $(window).scrollTop() < $(".top-designers").offset().top){
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"3px solid #fff"})
        $(".top-d").css({color:"#fff",borderBottom:"none"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"none"})
    }
    
   /////////////////when we reload in top-designers section///////////////////// 
    else if(x >= $(".top-designers").offset().top && x < $(".top-products").offset().top){
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"none"})
        $(".top-d").css({color:"#fff",borderBottom:"3px solid #fff"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"none"})
    }
    
    
/////////////////when we reload in top-products section/////////////////////
    else if(x >= $(".top-products").offset().top && x < $(".services").offset().top){
            $(".h").css({color:"#fff",borderBottom:"none"});
            $(".cat").css({color:"#fff",borderBottom:"none"})
            $(".top-d").css({color:"#fff",borderBottom:"none"})
            $(".top-p").css({color:"#fff",borderBottom:"3px solid #fff"})
            $(".serv").css({color:"#fff",borderBottom:"none"})
        }
    
/////////////////when we reload in service section/////////////////////
    else{
        $(".h").css({color:"#fff",borderBottom:"none"});
        $(".cat").css({color:"#fff",borderBottom:"none"})
        $(".top-d").css({color:"#fff",borderBottom:"none"})
        $(".top-p").css({color:"#fff",borderBottom:"none"})
        $(".serv").css({color:"#fff",borderBottom:"3px solid #fff"})
    }
    
     if(x>=$(".categories").offset().top){
        $(".navbar").css({backgroundColor:"rgba(44, 86, 106, 0.8)", transition:"all 0.5s",position:"fixed",top:"0",right:"0",left:"0",zIndex:"100"});
        $(".nav-link").css({color:"#fff"})}
    
    else{
        $(".navbar").css({position:"static",backgroundColor:"#fff"}) ;
        $(".nav-link").css({color:"#333"})}
}

 /////////////////////nav linke on click//////////////////////////
$(".nav-link").click(function(){
     var href = $(this).attr("href");
    let offset = $(href).offset().top+1;
    $("body").animate({scrollTop:offset},500);
})

 
//////////////scrolling function calling///////////////////////    
scrolling();

//////////////////////////////////when click on sign up////////////////////////
$(".sign-up").click(function(){
    $(".signin-form").css({transform:"rotateY(180deg)",backfaceVisibility:"hidden"}).hide(600);
    $(".signup-form").css({transform:"rotateY(0deg)",backfaceVisibility:"hidden"}).show(600);
})
////////////////////////////sign in/////////////////////////
$(".sign-in").click(function(){
    $(".signup-form").css({transform:"rotateY(-180deg)",backfaceVisibility:"hidden"}).hide(600);
    $(".signin-form").css({transform:"rotateY(0deg)",backfaceVisibility:"hidden"}).show(600);
})
/////////////////////sign up inputs validation/////////////////////

var passwordStaus = false;
$(".showPass").click(function(){
    var loginPassword =$("#inputPassword")
    if(passwordStaus === false){
        loginPassword.attr("type","text");
        passwordStaus = true;
    }
    else if(passwordStaus === true){
        loginPassword.attr("type","password");
        passwordStaus = false;
    }
})


var passwordSignup = false;
var confPasswordStaus = false;

    
$(".showInputPass").click(function(){
var Password =$("#password")
if(passwordSignup === false){
    Password.attr("type","text");
    passwordSignup = true;
}
else if(passwordSignup === true){
    Password.attr("type","password");
    passwordSignup = false;
}
})

$(".showConfirmPass").click(function(){
var confPassword =$("#confirm-pass")
if(confPasswordStaus === false){
    confPassword.attr("type","text");
    confPasswordStaus = true;
}
else if(confPasswordStaus === true){
    confPassword.attr("type","password");
    confPasswordStaus = false;
}
});

var nameRjx = /^[A-Z].{0,}[A-z]$/;
var mailRjx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
var passwordRjx= /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

var firstName=document.getElementById("first-name");
var lastName=document.getElementById("last-name");
var email=document.getElementById("email");
var password=document.getElementById("password");
var confPassword=document.getElementById("confirm-pass");
var feedback=document.getElementsByClassName("feedback");
var signupBtn=$(".signupBtn")
 

// signupBtn.click(function(){
//   // Validate first name
//     if(nameRjx.test(firstName.value) == false) {
//         alert("Warning First name must be at least 3 strings and started by capital!");
//     }
//     if(nameRjx.test(firstName.value) == false) {
//         alert("Warning Last name must be at least 3 strings and started by capital!");
//     }
//     if(mailRjx.test(email.value)==false){
//         alert("Invalid E-mail")  
//     }
//     if(passwordRjx.test(password.value)==false){
//         alert("Password must be at least 6, contains at least numeric digit, one uppercase and one lowercase letter");
//     }
//     if(password.value!= confPassword.value){
//         alert("Confirmation password must be as same as the password!")
//     }
    
// })



















