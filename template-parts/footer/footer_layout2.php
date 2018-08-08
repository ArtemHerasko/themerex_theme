<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Themerex_theme
 */

?>

<div class="col-md-6">
	<?php if ( is_active_sidebar( 'footer_widget_one' ) ) : ?>
		<div class="footer-widget-one" >
			<?php dynamic_sidebar( 'footer_widget_one' ); ?>
		</div>
	<?php endif; ?>
</div>
<div class="col-sm-6">
	<?php if ( is_active_sidebar( 'footer_widget_two' ) ) : ?>
		<div class="footer-widget-two" >
			<?php dynamic_sidebar( 'footer_widget_two' ); ?>
		</div>
	<?php endif; ?>
</div>
