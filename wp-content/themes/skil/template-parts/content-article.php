<?php
/**
 * Template part for displaying single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

the_content( sprintf(
	/* translators: %s: Name of current post. */
	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'skil' ), array( 'span' => array( 'class' => array() ) ) ),
	the_title( '<span class="screen-reader-text">"', '"</span>', false )
) );

wp_link_pages( array(
	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skil' ),
	'after'  => '</div>',
) );