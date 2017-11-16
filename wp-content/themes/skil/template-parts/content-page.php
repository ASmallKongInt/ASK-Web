<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

the_content();

wp_link_pages( array(
	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skil' ),
	'after'  => '</div>',
) );

edit_post_link(
	sprintf(
		/* translators: %s: Name of current post */
		esc_html__( 'Edit %s', 'skil' ),
		the_title( '<span class="screen-reader-text">"', '"</span>', false )
	),
	'<span class="edit-link">',
	'</span>'
);

