<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Themerex_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="page-wrapper">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'themerex_theme' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="main-menu-wrap">
				<div class="container">
					<nav id="site-navigation" class="main-navigation">
						<div class="menu-toggle">
							<span class="toggle-line item1"></span>
							<span class="toggle-line item2"></span>
							<span class="toggle-line item3"></span>
						</div>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div>

			<div class="header-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-2">
							<?php if ( is_active_sidebar( 'header_widget_left' ) ) : ?>
								<div class="header-widget-left" >
									<?php dynamic_sidebar( 'header_widget_left' ); ?>
								</div><!-- #Left widget area  -->
							<?php endif; ?>
						</div>

						<div class="col-lg-8">
							<div class="site-branding">
								<?php
								the_custom_logo();
								if ( is_front_page() && is_home() ) :
									?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							else :
								?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
							endif;
							$themerex_theme_description = get_bloginfo( 'description', 'display' );
							if ( $themerex_theme_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo $themerex_theme_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>

					<div class="col-lg-2">
						<?php if ( is_active_sidebar( 'header_widget_right' ) ) : ?>
							<div class="header-widget-right" >
								<?php dynamic_sidebar( 'header_widget_right' ); ?>
							</div><!-- #Right widget area  -->
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>


	</header><!-- #masthead -->

	<div id="content" class="site-content">
