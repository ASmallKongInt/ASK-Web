<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resumee
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main def_pages" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			<section class="footer-widget">
			        <?php
			            if ( ! dynamic_sidebar( 'footer-1' ) ) {
			            the_widget( 'WP_Widget_Recent_Posts' );
			            the_widget( 'WP_Widget_Meta' );
			            the_widget( 'WP_Widget_Archives' );
			            the_widget( 'WP_Widget_Categories' );
			                        } ?>
			        <div class="clearfix"></div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
