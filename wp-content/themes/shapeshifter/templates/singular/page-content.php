<?php
# Action Hook "shapeshifter_main_content_singular_page_content"
# Filter Hook "shapeshifter_filters_singular_content"

global $post, $shapeshifter_content_inner_width;

$post_type = get_post_type( $post );

shapeshifter_widget_areas_beginning_of_content();

echo '<div class="e-content entry-content shapeshifter-content' . esc_attr( 
	$post_type 
	? ' shapeshifter-content-' . $post_type 
	: '' 
) . '">
';
unset( $post_type );

	the_content();

	# for "<!--nextpage-->"
	$args = array(
		'before'           => '<div class="page-links-div"><span>' . esc_html__( 'Pages:', 'shapeshifter' ) . '</span>',
		'after'	           => '</div>',
		'link_before'      => '<span class="page-links-num">',
		'link_after'       => '</span>',
		'next_or_number'   => esc_attr( get_option( SHAPESHIFTER_THEME_OPTIONS . '_link_pages_select', 'number' ) ), // number or next
		'separator'        => ' ',
		'nextpagelink'     => esc_html__( 'Next Page', 'shapeshifter' ),
		'previouspagelink' => esc_html__( 'Prev Page', 'shapeshifter' ),
		'pagelink'         => '%',
		'echo'             => 0
	);

	echo wp_link_pages( $args );
	unset( $args );

echo '</div>';

shapeshifter_widget_areas_end_of_content();

