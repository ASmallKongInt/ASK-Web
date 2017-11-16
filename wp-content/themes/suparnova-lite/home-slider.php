<?php
/**
 * Template Name: Home Page Slider
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suparnova
 */
$suparnova_lite_disable_schema = suparnova_lite_global_get( 'suparnova_lite_disable_schema_markup', false );
get_header(); ?>
	<?php get_template_part( 'components/features/featured-content/featured', 'slider' ); ?>
	<div class="row">
		<div id="primary" class="<?php suparnova_lite_content_area_class(); ?>"<?php if( $suparnova_lite_disable_schema !== true ) { ?> itemscope itemType="http://schema.org/Blog"<?php } ?>>
			<main id="main" class="site-main" role="main">

			<h4 class="suparnova-lite-heading"><span><?php esc_html_e( 'Latest Posts', 'suparnova-lite' ); ?></span></h4>

			<?php

			$suparnova_lite_the_query = new WP_Query( array(
				'post_type' => 'post'
			) );

			if ( $suparnova_lite_the_query->have_posts() ) :

				/* Start the Loop */
				while ( $suparnova_lite_the_query->have_posts() ) : $suparnova_lite_the_query->the_post();
					
					get_template_part( 'components/post/content' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'components/post/content', 'none' );

			endif;

			wp_reset_postdata();
			
			?>

			</main>
		</div>
		<?php
		get_sidebar();
		get_sidebar( '2' ); ?>
	</div><!-- .row -->
<?php get_footer();
