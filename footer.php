<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Themerex_theme
 */

?>




<footer id="footer" class="site-footer" style="background:<?php echo get_theme_mod( 'themerex_theme_new_setting_name' ); ?>;">
	<div class="scroll-to-top">
		<a href="#"><i class="fa fa-angle-up"></i>TOP</a>
	</div>
	<div class="container footer-content">
		<div class="row">
			<?php 
			$part = get_theme_mod( 'themerex_theme_footer_layout_setting');
			get_template_part( 'template-parts/footer/'.$part );
			?>
		</div>
	</div>

</footer><!-- #footer -->

<footer class="sub-footer">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php if ( is_active_sidebar( 'sub_footer_widget' ) ) : ?>
					<div class="sub-footer-widget" >
						<?php dynamic_sidebar( 'sub_footer_widget' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

</footer><!-- #sub-footer -->
</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
