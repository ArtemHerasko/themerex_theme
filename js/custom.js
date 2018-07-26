//Mobile Menu
jQuery(document).ready(function(){
	jQuery('.menu-toggle').click(function(){
		jQuery('.main-navigation ul').toggle(300);
		jQuery(this).toggleClass('active');
	});
});




