<?php
/**
 * The template for displaying featured content
 *
 * @package Suparnova
 */
?>
<div id="featured-content" class="featured-content">
	<div class="featured-content-inner">
		<div class="post-column col-md-6 featured-big-post">
			<?php
			$suparnova_lite_query_args = array(
				'post_type'  => 'post',
				'posts_per_page' => 1,
				'meta_query' => array(
					array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
					),
				 )
			 );
			$suparnova_lite_feat_query = get_posts( $suparnova_lite_query_args );
			$suparnova_lite_feat_post = $suparnova_lite_feat_query[0];
			suparnova_lite_print_post( 4, $suparnova_lite_feat_post, 'square' );
			if( is_sticky( $suparnova_lite_feat_post->ID ) ) {
				printf( '<span class="suparnova-lite-badge">%s</span>', esc_html__( 'Featured', 'suparnova-lite' ) );
			} else {
				printf( '<span class="suparnova-lite-badge">%s</span>', esc_html__( 'Hot', 'suparnova-lite' ) );
			}
			?>
		</div>
		<div class="post-column col-md-6 featured-post-carousel">
			<div class="swiper-container">
				<div class="post-carousel-controls">
					<a href="#" class="slide-prev"><i class="fa fa-angle-left"></i></a>
					<a href="#" class="slide-next"><i class="fa fa-angle-right"></i></a>
				</div>
				<div class="swiper-wrapper">
					<?php

					$suparnova_lite_query_args = array(
						'post_type'  => 'post',
						'posts_per_page' => 12,
						'post__not_in' => array( $suparnova_lite_feat_post->ID ),
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'compare' => 'EXISTS'
							),
						 )
					 );

					$suparnova_lite_feat_query = get_posts( $suparnova_lite_query_args );
					
					$suparnova_lite_post_slices = array();
					$suparnova_lite_post_done = 0;
					
					while ( $suparnova_lite_post_done < count( $suparnova_lite_feat_query ) ) {
						$ranom_length = rand( 2, 3 );
						$suparnova_lite_post_slices[] = array_slice( $suparnova_lite_feat_query, $suparnova_lite_post_done, $ranom_length );
						$suparnova_lite_post_done += $ranom_length;
					}

					foreach ( $suparnova_lite_post_slices as $suparnova_lite_post_slice ) {
						$ranom_length = rand( 1, 2 );
						echo '<div class="swiper-slide post-carousel-slide">';
						switch( count( $suparnova_lite_post_slice ) ) {
							case 3:
								if( $ranom_length == 1 ) {
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[0], 'square', 'col-xs-6 post-column first' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[1], 'square', 'col-xs-6 post-column middle' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[2], 'wide', 'col-xs-12 post-column last' );
								} else {
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[0], 'taller', 'col-xs-6 post-column first' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[1], 'square', 'col-xs-6 post-column middle' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[2], 'square', 'col-xs-6 post-column last' );
								}
							break;
							case 2:
								if( $ranom_length == 1 ) {
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[0], 'taller', 'col-xs-6 post-column first' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[1], 'taller', 'col-xs-6 post-column middle' );
								} else {
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[0], 'wide', 'col-xs-12 post-column first' );
									suparnova_lite_print_post( 3, $suparnova_lite_post_slice[1], 'wide', 'col-xs-12 post-column middle' );
								}
							break;
							case 1:
								suparnova_lite_print_post( 3, $suparnova_lite_post_slice[0], 'square', 'col-xs-12 post-column first' );
							break;
						}
						echo '</div>';
					}

					wp_reset_postdata();

					?>
				</div>
			</div>
		</div>
	</div>
</div>
