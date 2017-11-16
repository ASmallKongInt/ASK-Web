<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
					<h1 class="page-title"><?php
					/* translators: %s: Current search query */
					printf( esc_html__( 'Search Results for: %s', 'suparnova-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'components/post/content', 'search' );

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