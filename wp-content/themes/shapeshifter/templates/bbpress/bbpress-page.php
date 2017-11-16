<?php
# Action Hook "shapeshifter_main_content_bbpress_page"
# Filter Hook "shapeshifter_filters_bbpress_page"

if ( have_posts() ) { while( have_posts() ) { the_post(); global $post;

	$post_type = get_post_type( $post->ID );

	echo '<div class="e-content entry-content shapeshifter-content' . esc_attr( 
		$post_type 
		? ' shapeshifter-content-' . $post_type 
		: '' 
	) . '">';
	
		unset( $post_type );
	
		the_content();

	echo '</div>';

} } else { esc_html_e( 'No Post', 'shapeshifter' ); }
