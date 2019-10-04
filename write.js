
$(document).ready(function(){
	$('.acc h3').click(function(){
		$(this).next('.content').slideToggle();
		$(this).parent().toggleClass('active');
		$(this).parent().siblings().children('.content').slideUp();
		$(this).parent().siblings().removeClass('active');
	});
});