// function newMessage() {
// 	var message = $(".input-mess").val();
// 	if($.trim(message) == '') {
// 		return false;
// 	}
// 	$('<div class="sent message"><div class="image"><img src="images/chatting/12.jpg" alt="" /></div><p>'+message+'</p></div>').appendTo($('.messages'));
// 	$('.input-mess').val(null);
// 	$('.contact.active .preview').html('<span class="you">you: </span>' + message);
// 	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
// }

// $('.send').click(function() {
//   newMessage();
// });

// $(window).on('keydown', function(e) {
//   if (e.which == 13) {
//     newMessage();
//     return false;
//   }
// });
