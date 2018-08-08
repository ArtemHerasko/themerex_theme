jQuery(document).ready(function(){
	//Mobile Menu
	jQuery('.menu-toggle').click(function(){
		jQuery('.main-navigation ul').toggle(300);
		jQuery(this).toggleClass('active');
	});
//Scroll to top
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 0) {
			jQuery('.scroll-to-top a').fadeIn();
		} else {
			jQuery('.scroll-to-top a').fadeOut();
		}
	});
	jQuery('.scroll-to-top a').click(function () {
		jQuery('body, html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

//Fixed header on scroll
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 700) {
			jQuery('header .main-menu-wrap').addClass('fixed');
		} else {
			jQuery('header .main-menu-wrap').removeClass('fixed');
		}
	});
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 400) {
			jQuery('header .main-menu-wrap').addClass('opacity');
		} else {
			jQuery('header .main-menu-wrap').removeClass('opacity');
		}
	});
});




