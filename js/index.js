$('a[href^="#"]').on('click', function(e) {
	e.preventDefault();

	$targetPosition = $($(this).attr('href')).offset().top;

	$('html, body').animate({
		scrollTop: $targetPosition
	}, 800)
})