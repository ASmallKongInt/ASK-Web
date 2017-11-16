<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Suparnova
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses suparnova_lite_header_style()
 */
function suparnova_lite_custom_header_setup() {
	
	if( function_exists( 'the_custom_logo' ) ) {
		add_theme_support( 'custom-logo', array(
			'height'      => 75,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	} else {
		add_theme_support( 'custom-header', apply_filters( 'suparnova_lite_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'width'                  => 200,
			'height'                 => 75,
			'flex-height'            => true,
			'flex-width'            => true,
			'wp-head-callback'       => 'suparnova_lite_header_style',
		) ) );
	}
	
}
add_action( 'after_setup_theme', 'suparnova_lite_custom_header_setup' );

if ( ! function_exists( 'suparnova_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see suparnova_lite_custom_header_setup().
 */
function suparnova_lite_header_style() {
	$header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // suparnova_lite_header_style