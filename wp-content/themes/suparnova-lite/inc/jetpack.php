<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package Suparnova
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function suparnova_lite_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'	=> 'suparnova_lite_infinite_scroll_render',
		'footer'	=> 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	add_theme_support( 'jetpack-social-menu' );

	add_theme_support( 'featured-content', array(
		'filter'	 => 'suparnova_lite_get_featured_posts',
		'max_posts'  => 20,
		'post_types' => array( 'post', 'page' ),
	) );
}
add_action( 'after_setup_theme', 'suparnova_lite_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function suparnova_lite_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'components/post/content', 'search' );
		else :	
			get_template_part( 'components/post/content' );
		endif;
	}
}

function suparnova_lite_social_menu() {
	$option = get_option( '_ts_social_media_urls' );
	$option = (array)$option;
	$array = suparnova_lite_social_media_array();
	?>
		<ul class="suparnova-lite-social-menu">
			<?php
				foreach ( $array as $media => $params ) {
					if( isset( $option[ $media ] ) && !empty( $option[ $media ] ) ) {
						echo sprintf( '<li><a href="%s"><i class="%s"></i></a></li>', esc_url( $option[ $media ] ), esc_attr( $params['icon'] ) );
					}
				}
			?>
		</ul>
	<?php
}

/**
 * Featured Posts
 */
function suparnova_lite_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'suparnova_lite_get_featured_posts', array() );
	if ( is_array( $featured_posts ) && 1 < count( $featured_posts ) ) {
		return true;
	}
	return false;
}
function suparnova_lite_get_featured_posts() {
	return apply_filters( 'suparnova_lite_get_featured_posts', false );
}
