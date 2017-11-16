<?php

$previous_post = get_previous_post();
$next_post = get_next_post();

if( !empty( $previous_post ) ) {
	if( has_post_thumbnail( $previous_post->ID ) ) {
		$previous = '<span class="nav-previous has-thumbnail">' . get_the_post_thumbnail( $previous_post, 'thumbnail' ) . '<span class="inner"><span class="label">' . esc_html__( 'Earlier:', 'suparnova-lite' ) . '</span><span class="title">' . esc_html( $previous_post->post_title ) . '</span></span>';
	} else {
		$previous = '<span class="label">' . esc_html__( 'Earlier:', 'suparnova-lite' ) . '</span><span class="title">' . esc_html( $previous_post->post_title ) . '</span>';
	}
} else {
	$previous = '';
}

if( !empty( $next_post ) ) {
	if( has_post_thumbnail( $next_post->ID ) ) {
		$next = '<span class="nav-next has-thumbnail">' . get_the_post_thumbnail( $next_post, 'thumbnail' ) . '<span class="inner"><span class="label">' . esc_html__( 'Up Next:', 'suparnova-lite' ) . '</span><span class="title">' . esc_html( $next_post->post_title ) . '</span></span></span>';
	} else {
		$next = '<span class="label">' . esc_html__( 'Up Next:', 'suparnova-lite' ) . '</span><span class="title">' . esc_html( $next_post->post_title ) . '</span>';
	}
} else {
	$next = '';
}

the_post_navigation( array(
	'next_text' => $next,
	'prev_text' => $previous,
) );