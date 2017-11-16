<?php
/**
 * Shows the top most area of the header
 */
$suparnova_lite_color_class = '';

if( 'dark' === suparnova_lite_theme_option( 'top_header_color' ) ) {
	$suparnova_lite_color_class .= ' dark-colors';
}

if( 'dark' === suparnova_lite_theme_option( 'top_header_sub_color' ) ) {
	$suparnova_lite_color_class .= ' dark-hover';
}
if( suparnova_lite_theme_option( 'top_header' ) ) {
	return;
}
?><div class="site-top-header<?php echo esc_attr( $suparnova_lite_color_class ); ?>">
	<div class="container">
		<div class="col-md-6 menu-left">
			<?php
			$left = suparnova_lite_theme_option( 'top_header_left' );
			switch ( $left ) :
			case 'text':
				echo '<p>' . wp_kses( suparnova_lite_theme_option('top_header_left_txt'), suparnova_lite_sanitize_html_array() ) . '</p>';
				break;
			case 'social':
				suparnova_lite_social_menu();
				break;
			case 'nav':
				wp_nav_menu( array(
					'depth' => 0,
					'theme_location' => 'menu-2',
					'fallback_cb' => 'suparnova_lite_fallback_menu',
				) );
				break;
			endswitch;
			?>
		</div><!-- .col-md-6 -->
		<div class="col-md-6 menu-right">
			<?php
			$left = suparnova_lite_theme_option( 'top_header_right' );
			switch ( $left ) :
			case 'text':
				echo '<p>' . wp_kses( suparnova_lite_theme_option('top_header_right_txt'), suparnova_lite_sanitize_html_array() ) . '</p>';
				break;
			case 'social':
				suparnova_lite_social_menu();
				break;
			case 'nav':
				wp_nav_menu( array(
					'depth' => 0,
					'theme_location' => 'menu-3',
					'fallback_cb' => 'suparnova_lite_fallback_menu',
				) );
				break;
			endswitch;
			?>
		</div><!-- .col-md-6 -->
	</div><!-- .container -->
</div><!-- .top-header -->
