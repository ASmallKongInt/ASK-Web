<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suparnova
 */
$suparnova_lite_disable_schema = suparnova_lite_global_get( 'suparnova_lite_disable_schema_markup', false );
get_header(); ?>
	<div class="row">
		<div id="primary" class="<?php suparnova_lite_content_area_class(); ?>"<?php if( $suparnova_lite_disable_schema !== true ) { ?> itemscope itemType="http://schema.org/Blog"<?php } ?>>
			<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) : the_post();
					
					get_template_part( 'components/post/content' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'components/post/content', 'none' );

			endif; ?>

			</main>
		</div>
		<?php
		get_sidebar();
		get_sidebar( '2' ); ?>
	</div><!-- .row -->
<?php get_footer();
