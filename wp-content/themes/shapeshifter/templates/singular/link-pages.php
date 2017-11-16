<?php
// for "<!--nextpage-->"
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
	'echo'             => 1
);
wp_link_pages( $args );
unset( $args );
