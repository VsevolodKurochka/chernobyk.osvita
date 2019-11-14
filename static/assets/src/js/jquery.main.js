$(document).ready(function(){

	function scroll(scrollLink, speed){
		$('html, body').animate({
			scrollTop: scrollLink.offset().top
		}, speed);
		return false;
	}
	$('.anchor').click(function(e){
		e.preventDefault();
		scroll($( $(this).attr('href') ), 1500);
	});
	$('[data-next-section]').click(function (e) {
		e.preventDefault();
		scroll($(this).closest('section, header').next(), 1500);
	});
});