jQuery(document).ready(function($) {
	$('#mobile-toggle').click(function(e) {
		e.preventDefault();
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).addClass('inactive');
			$('#site-navigation-bar').hide();
			$('#top-navigation').hide();
		}
		else {
			$(this).removeClass('inactive');
			$(this).addClass('active');
			$('#site-navigation-bar').show();
			$('#top-navigation').show();
		}
	});
	$('.subtitle-menu-toggle').click(function(e) {
		e.preventDefault();
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).addClass('inactive');
			$('#site-navigation-bar').hide();
			$('#top-navigation').hide();
		}
		else {
			$(this).removeClass('inactive');
			$(this).addClass('active');
			$('#site-navigation-bar').show();
			$('#top-navigation').show();
		}
	});

	$(window).resize(function() {
		var screen_width = $(window).width();
		if (screen_width >= 768) {
			$('#mobile-toggle').removeClass('active');
			$('#mobile-toggle').addClass('inactive');
			$('#site-navigation-bar').show();
			$('#top-navigation').show();
		}
		else {
			if ($('#mobile-toggle').hasClass('inactive')) {
				$('#site-navigation-bar').hide();
				$('#top-navigation').hide();
			}
		}
	});
});