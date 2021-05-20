/////////////////////////////////////////////////////////////////////////
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



$(".accessories-div").click(function(){
    $(".clothes").css({transform:"rotateY(180deg)",backfaceVisibility:"hidden"}).hide(600);
    $(".accessories").css({transform:"rotateY(0deg)",backfaceVisibility:"hidden"}).show(600);
})
////////////////////////////sign in/////////////////////////
$(".cloth-div").click(function(){
    $(".accessories").css({transform:"rotateY(-180deg)",backfaceVisibility:"hidden"}).hide(600);
    $(".clothes").css({transform:"rotateY(0deg)",backfaceVisibility:"hidden"}).show(600);
})



var smallCheck=$("#small");
var mediumCheck=$("#medium");
var largeCheck=$("#large");
var xlargeCheck=$("#xlarge");
var xxlargeCheck=$("#xxlarge");
var moreCheck=$("#more");

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


/*////////////////////////////////*/

/*********************************************smalll******************************************/
$("#small-red").click(function(){
    $(".small-red-num").toggle(1000);
})
$("#small-blue").click(function(){
    $(".small-blue-num").toggle(1000);
})
$("#small-yellow").click(function(){
    $(".small-yellow-num").toggle(1000);
})
$("#small-green").click(function(){
    $(".small-green-num").toggle(1000);
})
$("#small-purple").click(function(){
    $(".small-purple-num").toggle(1000);
})
$("#small-black").click(function(){
    $(".small-black-num").toggle(1000);
})
$("#small-white").click(function(){
    $(".small-white-num").toggle(1000);
})
$("#small-gray").click(function(){
    $(".small-gray-num").toggle(1000);
})

/*********************************************medium******************************************/
$("#medium-red").click(function(){
    $(".medium-red-num").toggle(1000);
})
$("#medium-blue").click(function(){
    $(".medium-blue-num").toggle(1000);
})
$("#medium-yellow").click(function(){
    $(".medium-yellow-num").toggle(1000);
})
$("#medium-green").click(function(){
    $(".medium-green-num").toggle(1000);
})
$("#medium-purple").click(function(){
    $(".medium-purple-num").toggle(1000);
})
$("#medium-black").click(function(){
    $(".medium-black-num").toggle(1000);
})
$("#medium-white").click(function(){
    $(".medium-white-num").toggle(1000);
})
$("#medium-gray").click(function(){
    $(".medium-gray-num").toggle(1000);
})


/*********************************************large******************************************/
$("#large-red").click(function(){
    $(".large-red-num").toggle(1000);
})
$("#large-blue").click(function(){
    $(".large-blue-num").toggle(1000);
})
$("#large-yellow").click(function(){
    $(".large-yellow-num").toggle(1000);
})
$("#large-green").click(function(){
    $(".large-green-num").toggle(1000);
})
$("#large-purple").click(function(){
    $(".large-purple-num").toggle(1000);
})
$("#large-black").click(function(){
    $(".large-black-num").toggle(1000);
})
$("#large-white").click(function(){
    $(".large-white-num").toggle(1000);
})
$("#large-gray").click(function(){
    $(".large-gray-num").toggle(1000);
})

/*********************************************xlarge******************************************/
$("#xlarge-red").click(function(){
    $(".xlarge-red-num").toggle(1000);
})
$("#xlarge-blue").click(function(){
    $(".xlarge-blue-num").toggle(1000);
})
$("#xlarge-yellow").click(function(){
    $(".xlarge-yellow-num").toggle(1000);
})
$("#xlarge-green").click(function(){
    $(".xlarge-green-num").toggle(1000);
})
$("#xlarge-purple").click(function(){
    $(".xlarge-purple-num").toggle(1000);
})
$("#xlarge-black").click(function(){
    $(".xlarge-black-num").toggle(1000);
})
$("#xlarge-white").click(function(){
    $(".xlarge-white-num").toggle(1000);
})
$("#xlarge-gray").click(function(){
    $(".xlarge-gray-num").toggle(1000);
})

/*********************************************xxlarge******************************************/
$("#xxlarge-red").click(function(){
    $(".xxlarge-red-num").toggle(1000);
})
$("#xxlarge-blue").click(function(){
    $(".xxlarge-blue-num").toggle(1000);
})
$("#xxlarge-yellow").click(function(){
    $(".xxlarge-yellow-num").toggle(1000);
})
$("#xxlarge-green").click(function(){
    $(".xxlarge-green-num").toggle(1000);
})
$("#xxlarge-purple").click(function(){
    $(".xxlarge-purple-num").toggle(1000);
})
$("#xxlarge-black").click(function(){
    $(".xxlarge-black-num").toggle(1000);
})
$("#xxlarge-white").click(function(){
    $(".xxlarge-white-num").toggle(1000);
})
$("#xxlarge-gray").click(function(){
    $(".xxlarge-gray-num").toggle(1000);
})

/*********************************************more******************************************/
$("#more-red").click(function(){
    $(".more-red-num").toggle(1000);
})
$("#more-blue").click(function(){
    $(".more-blue-num").toggle(1000);
})
$("#more-yellow").click(function(){
    $(".more-yellow-num").toggle(1000);
})
$("#more-green").click(function(){
    $(".more-green-num").toggle(1000);
})
$("#more-purple").click(function(){
    $(".more-purple-num").toggle(1000);
})
$("#more-black").click(function(){
    $(".more-black-num").toggle(1000);
})
$("#more-white").click(function(){
    $(".more-white-num").toggle(1000);
})
$("#more-gray").click(function(){
    $(".more-gray-num").toggle(1000);
})

/*imagedesign-mediuminput
design-image-medium*/
function smallPreviewFile() {
    var smallPreview = document.querySelector('.design-image-small');
    var smallFile    = document.querySelector('.imagedesign-smallinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    smallPreview.src = reader.result;
  }

  if (smallFile) {
      reader.readAsDataURL(smallFile);
  } else {
      smallPreview.src = "";
  }
}
function mediumPreviewFile() {
    var mediumPreview = document.querySelector('.design-image-medium');
    var mediumFile    = document.querySelector('.imagedesign-mediuminput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    mediumPreview.src = reader.result;
  }

  if (mediumFile) {
      reader.readAsDataURL(mediumFile);
  } else {
      mediumPreview.src = "";
  }
}
function largePreviewFile() {
    var largePreview = document.querySelector('.design-image-large');
    var largeFile    = document.querySelector('.imagedesign-largeinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    largePreview.src = reader.result;
  }

  if (largeFile) {
      reader.readAsDataURL(largeFile);
  } else {
      largePreview.src = "";
  }
}
function xlargePreviewFile() {
    var xlargePreview = document.querySelector('.design-image-xlarge');
    var xlargeFile    = document.querySelector('.imagedesign-xlargeinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    xlargePreview.src = reader.result;
  }

  if (xlargeFile) {
      reader.readAsDataURL(xlargeFile);
  } else {
      xlargePreview.src = "";
  }
}
function xxlargePreviewFile() {
    var xxlargePreview = document.querySelector('.design-image-xxlarge');
    var xxlargeFile    = document.querySelector('.imagedesign-xxlargeinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    xxlargePreview.src = reader.result;
  }

  if (xxlargeFile) {
      reader.readAsDataURL(xxlargeFile);
  } else {
      xxlargePreview.src = "";
  }
}
function morePreviewFile() {
    var morePreview = document.querySelector('.design-image-more');
    var moreFile    = document.querySelector('.imagedesign-moreinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    morePreview.src = reader.result;
  }

  if (moreFile) {
      reader.readAsDataURL(moreFile);
  } else {
      morePreview.src = "";
  }
}

/*accessories*/
function accessoriesPreviewFile() {
    var accessoriesPreview = document.querySelector('.design-image-accessories');
    var accessoriesFile    = document.querySelector('.imagedesign-accessoriesinput').files[0];
    
    var reader  = new FileReader();


  reader.onloadend = function () {
    accessoriesPreview.src = reader.result;
  }

  if (accessoriesFile) {
      reader.readAsDataURL(accessoriesFile);
  } else {
      accessoriesPreview.src = "";
  }
}


$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });
    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();   
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){
        readURL(this);
    }); 	
});

// Days
var x = `<option value="">Day</option>`;
for(var i=1; i<=31;i++){
    x+="<option value="+ i +">"+i+"</option>";
}
document.getElementById("days").innerHTML=x;

// Years
var y = `<option value="">Year</option>`;
for(var i=1970; i<=2015;i++){
    y+="<option value="+ i +">"+i+"</option>";
}
document.getElementById("years").innerHTML=y;

















