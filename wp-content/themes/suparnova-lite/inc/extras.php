<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Suparnova
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function suparnova_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() || is_page_template( 'home-blocks.php' ) || is_page_template( 'home-slider.php' ) ) {
		$classes[] = 'hfeed';
	}
	
	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'suparnova_lite_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post article element.
 * @return array
 */
function suparnova_lite_post_classes( $classes ) {
	
	if( !has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}
	
	if( !is_sticky() ) {
		$classes[] = 'non-sticky';
	}

	return $classes;
}
add_filter( 'post_class', 'suparnova_lite_post_classes' );

/**
 * Inline styles
 */
function suparnova_lite_inline_css() {
	
	$css = '';
	
	$logo_area_height = suparnova_lite_theme_option( 'logo_area_height' );
	
	if( empty( $logo_area_height ) ) {
		$logo_area_height = 100;
	}
	
	$css .= '.site-branding > .container {';
	$css .= 'height: ' . intval( $logo_area_height ) . 'px';
	$css .= '}';
	
	return $css;
	
}

/**
 * Foorer Widgets
 */
function suparnova_lite_footer_widgets() {
	
	$option = suparnova_lite_theme_option( 'footer_widgets' );
	
	$available = false;
	
	if( empty( $option ) && !is_customize_preview() ) {
		return;
	}
	
	?>
	<div class="suparnova-lite-footer-widgets">
		<div class="container">
			<div class="row">
				<?php
				for ( $i = 1; $i <= 4; $i++ ) {
					?><div class="col-md-3"><?php
					if( is_active_sidebar( 'footer-' . $i ) ) {
						dynamic_sidebar( 'footer-' . $i );
					}
					?></div><?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Footer banner
 */
function suparnova_lite_footer_banner() {
	
	$banner = suparnova_lite_theme_option( 'footer_banner' );
	
	if( empty( $banner ) && !is_customize_preview() ) {
		return;
	}
	
	?>
	<div class="suparnova-lite-footer-banner">
		<div class="banner-inner">
			<?php echo wp_kses( $banner, suparnova_lite_banner_allowed_html() ); ?>
		</div>
	</div>
	<?php
	
}

/**
 * Container actions
 */
add_action( 'suparnova_lite_container_sart', 'suparnova_lite_container_sart' );
add_action( 'suparnova_lite_container_end', 'suparnova_lite_container_end' );

function suparnova_lite_container_sart() {
	?><div class="container"><?php
}

function suparnova_lite_container_end() {
	?></div><!-- .container --><?php
}

/**
 * Fallback for nav menu
 */
function suparnova_lite_fallback_menu() {
	?>
	<div class="menu-root fallback-menu-container">
		<ul class="menu">
			<?php if( current_user_can( 'edit_theme_options' ) ) : ?>
			<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Add Menu', 'suparnova-lite' ); ?></a></li>
			<?php else: ?>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'suparnova-lite' ); ?></a></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php
}


/*
 * Find and change markup of widgets to get numbers inside link
 */
add_filter( 'get_archives_link', 'suparnova_lite_inline_posts_count' );
add_filter( 'wp_list_categories', 'suparnova_lite_inline_posts_count_cats', 10, 2 );

function suparnova_lite_inline_posts_count( $links ) {	
    $get_count = preg_match_all( '#\((.*?)\)#', $links, $matches );

    if( $matches ) {
        foreach( $matches[0] as $val ) {
            $links = str_replace( '</a> ' . $val, ' ' . $val . '</a>', $links );
            $links = str_replace( '</a>&nbsp;' . $val, '<span class="count">' . filter_var( $val, FILTER_SANITIZE_NUMBER_INT) . '</span></a>', $links );
        }
    }

    return $links;
}

function suparnova_lite_inline_posts_count_cats( $links, $args ) {
	if( isset( $args['show_count'] ) && $args['show_count'] == 1 ) {

		$links_array = explode( '</li>', $links );

		foreach( $links_array as $i => $link ) {

			$get_count = preg_match_all( '#\((.*?)\)#', $link, $matches );

			if( $matches ) {
				foreach( $matches[0] as $val ) {
					$links_array[$i] = str_replace( '</a> ' . $val, ' ' . $val . '</a>', $link );
					$links_array[$i] = str_replace( '</a>&nbsp;' . $val, '<span class="count">' . filter_var( $val, FILTER_SANITIZE_NUMBER_INT) . '</span></a>', $link );
					$links_array[$i] = str_replace( '</a> ' . $val, '<span class="count">' . filter_var( $val, FILTER_SANITIZE_NUMBER_INT) . '</span></a>', $link );
				}
			}

		}

		return implode( '</li>', $links_array );
	}
	
	return $links;	
}

/**
 * Modfify the password protected form
 */
add_filter( 'the_password_form', 'suparnova_lite_custom_password_form' );

function suparnova_lite_custom_password_form() {
    global $post;
	
    $id = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	
	$output = sprintf( '<form action="%s" class="post-password-form" method="post"><p>%s</p><p class="password-input"><label for="%s"><span class="screen-reader-text">%s</span><input name="post_password" id="%s" type="password" placeholder="%s"></label><button type="submit" name="Submit"><i class="fa fa-arrow-right"></i></button></p></form>',
		esc_url( site_url( 'wp-login.php?action=postpass' ) ),
		esc_html__( 'This content is password protected. To view it please enter your password below:', 'suparnova-lite' ),
		esc_attr( $id ),
		esc_html__( 'Password:', 'suparnova-lite' ),
		esc_attr( $id ),
		esc_attr__( 'Password', 'suparnova-lite' )
	);
	
    return $output;
}

/**
 * Comments callback function
 */
function suparnova_lite_comment_callback( $comment, $args, $depth ) {
	/* translators: 1: comment date, 2: comment time */
	$time_string = sprintf( esc_html__( '%1$s at %2$s', 'suparnova-lite' ), get_comment_date( '', $comment ), get_comment_time() );
	/* translators: %s: human-readable time difference */
	$hrt_string = sprintf( esc_html_x( '%s ago', '%s = human-readable time difference', 'suparnova-lite' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
	$classes = array();
	$classes[] = $args['has_children'] ? 'parent' : 'barren';
	if( !comments_open() ) {
		$classes[] = 'reply-not-allowed';
	} else {
		$classes[] = 'reply-allowed';
	}
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( implode( ' ', $classes ), $comment ); ?>>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<h5 class="author-title"><?php
						/* translators: %s: comment author link */
						printf( wp_kses_post( __( '%s <span class="says">says:</span>', 'suparnova-lite' ) ),
							sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
						);
						?></h5>
				</div><!-- .comment-author -->

				<h6 class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>" title="<?php echo esc_attr( suparnova_lite_theme_option( 'enable_hrt_comment' ) == true ? $time_string : $hrt_string ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							if( suparnova_lite_theme_option( 'enable_hrt_comment' ) == true ) {
								echo esc_html( $hrt_string );
							} else {
								echo esc_html( $time_string );
							}
							?>
						</time>
					</a>
				</h6><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'suparnova-lite' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			ob_start();
			edit_comment_link( esc_html__( 'Edit', 'suparnova-lite' ) );
			$edit = ob_get_clean();
			comment_reply_link( array_merge( $args, array(
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<h6 class="cooment-links">' . $edit,
				'after'     => '</h6>'
			) ) );
			?>
		</div><!-- .comment-body -->
	<?php
}

/**
 * All in one social media solution
 */
function suparnova_lite_social_media_array() {
	
	$medias = array(
		'facebook' => array(
			'title' => __( 'Facebook', 'suparnova-lite' ),
			'color' => '#3b5998',
			'icon' => 'fa fa-facebook',
			'share' => '',
		),
		'twitter' => array(
			'title' => __( 'Twitter', 'suparnova-lite' ),
			'color' => '#00aced',
			'icon' => 'fa fa-twitter',
			'share' => '',
		),
		'instagram' => array(
			'title' => __( 'Instagram', 'suparnova-lite' ),
			'color' => '#bc2a8d',
			'icon' => 'fa fa-instagram',
			'share' => '',
		),
		'googleplus' => array(
			'title' => __( 'Google Plus', 'suparnova-lite' ),
			'color' => '#de5246',
			'icon' => 'fa fa-google-plus',
			'share' => '',
		),
		'pinterest' => array(
			'title' => __( 'Pinterest', 'suparnova-lite' ),
			'color' => '#cb2027',
			'icon' => 'fa fa-pinterest',
			'share' => '',
		),
		'linkedin' => array(
			'title' => __( 'Linkedin', 'suparnova-lite' ),
			'color' => '#007bb6',
			'icon' => 'fa fa-linkedin',
			'share' => '',
		),
		'youtube' => array(
			'title' => __( 'Youtube', 'suparnova-lite' ),
			'color' => '#ea3517',
			'icon' => 'fa fa-youtube',
			'share' => '',
		),
		'vimeo' => array(
			'title' => __( 'Vimeo', 'suparnova-lite' ),
			'color' => '#1ab7ea',
			'icon' => 'fa fa-vimeo',
			'share' => '',
		),
		'vine' => array(
			'title' => __( 'Vine', 'suparnova-lite' ),
			'color' => '#00bf8f',
			'icon' => 'fa fa-vine',
			'share' => '',
		),
		'tumblr' => array(
			'title' => __( 'Tumblr', 'suparnova-lite' ),
			'color' => '#32506d',
			'icon' => 'fa fa-tumblr',
			'share' => '',
		),
		'flickr' => array(
			'title' => __( 'Flickr', 'suparnova-lite' ),
			'color' => '#ff0084',
			'icon' => 'fa fa-flickr',
			'share' => '',
		),
		'dribbble' => array(
			'title' => __( 'Dribbble', 'suparnova-lite' ),
			'color' => '#ea4c89',
			'icon' => 'fa fa-dribbble',
			'share' => '',
		),
		'quora' => array(
			'title' => __( 'Quora', 'suparnova-lite' ),
			'color' => '#a82400',
			'icon' => 'fa fa-quora',
			'share' => '',
		),
		'reddit' => array(
			'title' => __( 'Reddit', 'suparnova-lite' ),
			'color' => '#ff4500',
			'icon' => 'fa fa-reddit',
			'share' => '',
		),
		'vk' => array(
			'title' => __( 'VK', 'suparnova-lite' ),
			'color' => '#45668e',
			'icon' => 'fa fa-vk',
			'share' => '',
		),
		'wordpress' => array(
			'title' => __( 'WordPress', 'suparnova-lite' ),
			'color' => '#21759b',
			'icon' => 'fa fa-wordpress',
			'share' => '',
		),
		'medium' => array(
			'title' => __( 'Medium', 'suparnova-lite' ),
			'color' => '#00ab6b',
			'icon' => 'fa fa-medium',
			'share' => '',
		),
		'stumbleupon' => array(
			'title' => __( 'StumbleUpon', 'suparnova-lite' ),
			'color' => '#EB4823',
			'icon' => 'fa fa-stumbleupon',
			'share' => '',
		),
		'blogger' => array(
			'title' => __( 'Blogger', 'suparnova-lite' ),
			'color' => '#fb8f3d',
			'icon' => 'fa fa-rss',
			'share' => '',
		),
		'soundcloud' => array(
			'title' => __( 'SoundCloud', 'suparnova-lite' ),
			'color' => '#ff3a00',
			'icon' => 'fa fa-soundcloud',
			'share' => '',
		),
		'stackoverflow' => array(
			'title' => __( 'StackOverflow', 'suparnova-lite' ),
			'color' => '#f48024',
			'icon' => 'fa fa-stack-overflow',
			'share' => '',
		),
		'github' => array(
			'title' => __( 'GitHub', 'suparnova-lite' ),
			'color' => '#333333',
			'icon' => 'fa fa-github',
			'share' => '',
		),
	);
	
	return $medias;
	
}