<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Suparnova
 */

if ( ! function_exists( 'suparnova_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function suparnova_lite_posted_on() {
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

	$posted_on = sprintf(
		/* translators: %s: post date */
		esc_html_x( 'Posted on %s', 'post date', 'suparnova-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author */
		esc_html_x( 'by %s', 'post author', 'suparnova-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'suparnova_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function suparnova_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'suparnova-lite' ) );
		if ( $categories_list && suparnova_lite_categorized_blog() ) {
			/* translators: %1$s: post categories */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'suparnova-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'suparnova-lite' ) );
		if ( $tags_list ) {
			/* translators: %s: post tags */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'suparnova-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: number of comments */
		comments_popup_link( esc_html__( 'Leave a comment', 'suparnova-lite' ), esc_html__( '1 Comment', 'suparnova-lite' ), esc_html__( '% Comments', 'suparnova-lite' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'suparnova-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function suparnova_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'suparnova_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'suparnova_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so suparnova_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so suparnova_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in suparnova_lite_categorized_blog.
 */
function suparnova_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'suparnova_lite_categories' );
}
add_action( 'edit_category', 'suparnova_lite_category_transient_flusher' );
add_action( 'save_post',     'suparnova_lite_category_transient_flusher' );

/**
 * Smart menu builder
 */
function suparnova_lite_smart_menu() {
	?>
	<ul class="menu suparnova-lite-smart-menu">
		<li class="menu-item-user">
			<?php
			$login = Suparnova_Lite_Login::init();
			if( is_user_logged_in() ) {
				echo sprintf( '<a href="%s" class="user-logged-in"><i class="fa fa-user"></i>%s</a>', esc_url( Suparnova_Lite_Login::profileurl() ), esc_html( 'My Profile', 'suparnova-lite' ) );
			} else {
				echo sprintf( '<a data-toggle="modal" href="#login_modal" class="user-not-logged-in"><i class="fa fa-user"></i>%s</a>', esc_html( 'Log in', 'suparnova-lite' ) );
			}
			?>
		</li>
	</ul>
	<?php
}

/**
 * Generate url for google fonts
 * 
 * @return string
 */
function suparnova_lite_fonts_url() {
	$fonts_url = '';
	 
	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lora = _x( 'on', 'Lora font: on or off', 'suparnova-lite' );
	 
	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lato = _x( 'on', 'Lato font: on or off', 'suparnova-lite' );
	 
	if ( 'off' !== $lora || 'off' !== $open_sans ) {
		$font_families = array();

		if ( 'off' !== $lora ) {
			$font_families[] = 'Lora:400,400i,700,700i';
		}

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:300,300i,400,400i,700,700i,900,900i';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );
}

/**
 * Wrapper of cs_get_option to handle case of no framework enabled
 * 
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function suparnova_lite_option( $key, $default = false ) {
	if( function_exists( 'cs_get_option' ) ) {
		cs_get_option( $key, $default );
	} elseif( class_exists( 'Suparnova_Lite_CSFramework_Setup' ) ) {
		$options = Suparnova_Lite_CSFramework_Setup::theme_options();
		foreach( $options as $option ) {
			$found = suparnova_lite_get_option_out( $option, $key );
			if( !is_null( $found ) ) {
				return $found;
			}
		}
	}
	return $default;
}

function suparnova_lite_get_option_out( $menu, $key ) {
	if( isset( $menu['fields'] ) ) {
		foreach( $menu['fields'] as $field ) {
			if( $field['name'] == $key ) {
				return isset( $field['default'] ) ? $field['default'] : null;
			}
		}
	} elseif( isset( $menu['sections'] ) ) {
		return suparnova_lite_get_option_out( $menu['sections'], $key );
	}
}

/**
 * Print a post by id or from loop
 */
function suparnova_lite_print_post( $style = 0, $post_id = null, $size = 'auto', $wrapper_class = '' ) {
	
	global $post;
	
	$post_new = get_post( $post_id );
	
	setup_postdata( $post_new );
	
	$post_thumbnail_class = has_post_thumbnail() ? '' : ' no-post-thumbnail';
	
	if( ! empty( $wrapper_class ) ) {
		printf( '<div class="%s">', esc_attr( $wrapper_class ) );
	}
	
	switch( $style ) :
		case 1:
			?>
			<div class="suparnova-lite-block-post<?php echo esc_attr( $post_thumbnail_class ); ?>">
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('suparnova-lite-thumbnail'); ?>
				</div>
				<div class="entry-content">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php get_template_part( 'components/post/content', 'category' ); ?>
				</div>
			</div>
			<?php
			break;
		case 2:
			?>
			<div class="suparnova-lite-block-post<?php echo esc_attr( $post_thumbnail_class ); ?>">
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('suparnova-lite-thumbnail'); ?>
				</div>
				<div class="entry-content">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php get_template_part( 'components/post/content', 'meta' ); ?>
				</div>
			</div>
			<?php
			break;
		case 3:
			if( !empty( $size ) ) {
				$post_thumbnail_class .= ' size-' . $size;
			}
			?>
			<div class="suparnova-lite-block-post post-image-bg<?php echo esc_attr( $post_thumbnail_class ); ?>" style="background-image: url(<?php the_post_thumbnail_url('suparnova-lite-thumbnail'); ?>)">
				<div class="entry-content">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php get_template_part( 'components/post/content', 'category' ); ?>
				</div>
			</div>
			<?php
			break;
		case 4:
			if( !empty( $size ) ) {
				$post_thumbnail_class .= ' size-' . $size;
			}
			?>
			<div class="suparnova-lite-block-post post-image-bg<?php echo esc_attr( $post_thumbnail_class ); ?>" style="background-image: url(<?php the_post_thumbnail_url('suparnova-lite-thumbnail'); ?>)">
				<div class="entry-content">
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php get_template_part( 'components/post/content', 'meta' ); ?>
				</div>
			</div>
			<?php
			break;
		default:
				get_template_part( 'components/post/content' );
			break;
	endswitch;
	
	wp_reset_postdata();
	
	if( ! empty( $wrapper_class ) ) {
		echo '</div>';
	}
	
}

/**
 * Set global variable
 */
function suparnova_lite_global_set( $name, $value ) {
	$GLOBALS[ $name ] = $value;
}

/**
 * Get global variable
 */
function suparnova_lite_global_get( $name, $default = false ) {
	if( !isset( $GLOBALS[ $name ] ) ) {
		return $default;
	}
	return $GLOBALS[ $name ];
}

/**
 * Get current page url
 */
function suparnova_lite_get_current_url() {
	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
}

/**
 * Get current sidebar ID based on query
 */
function suparnova_lite_get_current_sidebar( $n = 1 ) {
	return 'sidebar-' . $n;
}

/**
 * Get layout
 */
function suparnova_lite_get_layout() {
	return array( 2, 7, 3 );
}

/**
 * Get class for content area
 */
function suparnova_lite_content_area_class( $echo = true ) {
	
	$layout = suparnova_lite_get_layout();
	$classes = array( 'content-area' );
	$col_size = suparnova_lite_global_get( 'suparnova_lite_blog_layout_size', 'md' );
	
	if( !is_active_sidebar( suparnova_lite_get_current_sidebar( 1 ) ) && !is_active_sidebar( suparnova_lite_get_current_sidebar( 2 ) ) ) {
		$classes[] = 'col-xs-12';
	}
	
	if( is_active_sidebar( suparnova_lite_get_current_sidebar( 1 ) ) && !is_active_sidebar( suparnova_lite_get_current_sidebar( 2 ) ) ) {
		$classes[] = 'col-' . $col_size . '-' . ( $layout[0] + $layout[1] );
	}
	
	if( !is_active_sidebar( suparnova_lite_get_current_sidebar( 1 ) ) && is_active_sidebar( suparnova_lite_get_current_sidebar( 2 ) ) ) {
		$classes[] = 'col-' . $col_size . '-' . ( $layout[1] + $layout[2] );
		$classes[] = 'col-' . $col_size . '-push-' . $layout[0];
	}
	
	if( is_active_sidebar( suparnova_lite_get_current_sidebar( 1 ) ) && is_active_sidebar( suparnova_lite_get_current_sidebar( 2 ) ) ) {
		$classes[] = 'col-' . $col_size . '-' . $layout[1];
		$classes[] = 'col-' . $col_size . '-push-' . $layout[0];
	}
	
	$classes = apply_filters( 'suparnova_lite_content_area_classes', $classes );
	
	if( $echo ) {
		echo esc_attr( implode( ' ', $classes ) );
	} else {
		return $classes;
	}
	
}

/**
 * Get class for left sidebar
 */
function suparnova_lite_left_sidebar_class( $echo = true ) {
	
	$layout = suparnova_lite_get_layout();
	$classes = array( 'widget-area' );
	$col_size = suparnova_lite_global_get( 'suparnova_lite_blog_layout_size', 'md' );
	
	$classes[] = 'col-' . $col_size . '-' . $layout[0];
	$classes[] = 'col-' . $col_size . '-pull-' . ( $layout[1] + $layout[2] );
	
	$classes = apply_filters( 'suparnova_lite_left_sidebar_classes', $classes );
	
	if( $echo ) {
		echo esc_attr( implode( ' ', $classes ) );
	} else {
		return $classes;
	}
	
}

/**
 * Get class for right sidebar
 */
function suparnova_lite_right_sidebar_class( $echo = true ) {
	
	$layout = suparnova_lite_get_layout();
	$classes = array( 'widget-area' );
	$col_size = suparnova_lite_global_get( 'suparnova_lite_blog_layout_size', 'md' );
	
	$classes[] = 'col-' . $col_size . '-' . $layout[2];
	
	if( is_active_sidebar( suparnova_lite_get_current_sidebar( 2 ) ) ) {
		$classes[] = 'col-' . $col_size . '-push-' . $layout[0];
	}
	
	$classes = apply_filters( 'suparnova_lite_right_sidebar_classes', $classes );
	
	if( $echo ) {
		echo esc_attr( implode( ' ', $classes ) );
	} else {
		return $classes;
	}
	
}