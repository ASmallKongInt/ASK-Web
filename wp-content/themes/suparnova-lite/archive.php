<?php
/**
 * The template for displaying archive pages
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
			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					
					get_template_part( 'components/post/content' );

				endwhile;

				the_posts_navigation();

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