<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Themerex_theme
 */

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						

			// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comment_form();
						paginate_comments_links();
						
						$args = array(
							'walker'            => null,
							'max_depth'         => '',
							'style'             => 'ul',
							'callback'          => null,
							'end-callback'      => null,
							'type'              => 'all',
							'reply_text'        => 'Reply',
							'page'              => '',
							'per_page'          => '',
							'avatar_size'       => 32,
							'reverse_top_level' => null,
							'reverse_children'  => '',
                	'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
                	'short_ping'        => false,   // @since 3.6
                    'echo'              => true     // boolean, default is true
                  );
						wp_list_comments( $args );
					endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->
</div>

<div class="col-md-4">
	<?php get_sidebar(); ?>
</div>
</div>
</div>

<?php get_footer();