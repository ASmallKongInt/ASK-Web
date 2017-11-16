<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Floral
 */

/**
 * Prints HTML with meta information for the current post-date/time and categories, tags..
 */
function floral_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.

	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'floral-lite' ) );
	if ( $categories_list && floral_categorized_blog() ) {
		printf( '<span class="cat-links"><i class="fa fa-folder-open"></i><span class="screen-reader-text">%1$s </span>%2$s</span>', esc_html__( 'Categories', 'floral-lite' ), $categories_list ); // WPCS: XSS OK.
	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'floral-lite' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags"></i>' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments-o"></i>';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'floral-lite' ), array(
			'span' => array(
				'class' => array(),
			),
		) ), get_the_title() ) );
		echo '</span>';
	}
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function floral_featured_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function floral_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'floral-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function floral_categorized_blog() {
	$all_the_cool_cats = get_transient( 'floral_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'floral_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so floral_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so floral_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in floral_categorized_blog.
 */
function floral_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'floral_categories' );
}
add_action( 'edit_category', 'floral_category_transient_flusher' );
add_action( 'save_post',     'floral_category_transient_flusher' );

/**
 * Change the tag could args
 *
 * @param array $args Widget parameters.
 *
 * @return mixed
 */
function floral_tag_cloud_args( $args ) {
	$args['largest']  = 1; // Largest tag.
	$args['smallest'] = 1; // Smallest tag.
	$args['unit']     = 'rem'; // Tag font unit.

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'floral_tag_cloud_args' );

/**
 * Getter function for Featured Content.
 *
 * @return array An array of WP_Post objects.
 */
function floral_get_featured_posts() {
	return apply_filters( 'floral_get_featured_posts', array() );
}
