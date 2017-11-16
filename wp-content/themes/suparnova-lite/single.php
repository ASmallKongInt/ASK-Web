<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Suparnova
 */

get_header(); ?>
	<div class="row">
		<div id="primary" class="<?php suparnova_lite_content_area_class(); ?>">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
					
				get_template_part( 'components/post/content' );

				get_template_part( 'components/post/content', 'navigation' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</main>
		</div>
		<?php
		get_sidebar();
		get_sidebar( '2' ); ?>
	</div><!-- .row -->
<?php get_footer();
