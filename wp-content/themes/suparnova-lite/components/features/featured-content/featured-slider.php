<?php
/**
 * The template for displaying featured slider
 *
 * @package Suparnova
 */
$suparnova_lite_feat_query = new WP_Query( array(
	'post_type'  => 'post',
	'posts_per_page' => 6,
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		),
	 ),
	'ignore_sticky_posts' => true,
 ) );
?>
<div class="suparnova-lite-featured-slider">
	<div class="swiper-container">
		<div class="post-carousel-controls">
			<a href="#" class="slide-prev"><i class="fa fa-angle-left"></i></a>
			<a href="#" class="slide-next"><i class="fa fa-angle-right"></i></a>
		</div>
		<div class="swiper-wrapper">
		<?php
		while( $suparnova_lite_feat_query->have_posts() ) : $suparnova_lite_feat_query->the_post();
			?>
			<div class="swiper-slide post-slide" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>)">
				<div class="slider-inner">
					<div class="slide-card">
						<?php get_template_part( 'components/post/content', 'category' ); ?>
						<h2 class="post-title"><?php the_title(); ?></h2>
						<?php get_template_part( 'components/post/content', 'meta' ); ?>
						<p class="block-post-content"><?php echo wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 15, '...' ) ); ?></p>
						<a href="<?php the_permalink(); ?>" class="btn btn-inline"><?php esc_html_e( 'Read More', 'suparnova-lite' ); ?></a>
					</div>
				</div>
			</div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
		</div>
	</div>
</div>