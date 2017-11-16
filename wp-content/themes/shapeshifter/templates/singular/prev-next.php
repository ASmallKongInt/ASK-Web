<?php
# Action Hook "shapeshifter_main_content_singular_page_prev_next"
# Filter Hook "shapeshifter_filters_singular_prev_next"

global $post;
$post_type = get_post_type( $post );
if ( 'post' === $post_type ) {

	echo '<div class="p-navi clearfix single-page-prev-next">';

		$prev_post = get_previous_post(); 
		if ( ! empty( $prev_post ) ) {
			echo '<a class="prev-post-title-p-a" href="' . esc_url( get_the_permalink( absint( $prev_post->ID ) ) ) . '" rel="prev">';
				echo '<div class="prev-post">';
					echo '<p class="prev-post-link-p">';
						esc_html_e( 'Prev Page', 'shapeshifter' );
					echo '</p>';
						echo '<p class="prev-post-title-p">';
							echo get_the_title( $prev_post->ID );
						echo '</p>';
				echo '</div>';
			echo '</a>';
		} unset( $prev_post );

		$next_post = get_next_post();
		if ( ! empty( $next_post ) ) {
			echo '<a class="next-post-title-p-a" href="' . esc_url( get_the_permalink( absint( $next_post->ID ) ) ) . '" rel="next">';
				echo '<div class="next-post">';
					echo '<p class="next-post-link-p">';
						esc_html_e( 'Next Page', 'shapeshifter' );
					echo '</p>';
					echo '<p class="next-post-title-p">';
						echo get_the_title( $next_post->ID );
					echo '</p>';
				echo '</div>';
			echo '</a>';
		} unset( $next_post );

	echo '</div>';

}
