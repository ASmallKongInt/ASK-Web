<?php
/**
 * Renders the social media links on footer
 */

$suparnova_lite_enable_socials = suparnova_lite_theme_option( 'footer_socials' );

if( empty( $suparnova_lite_enable_socials ) ) {
	return;
}

?><div class="site-social">
	<?php
	$suparnova_lite_social_option = get_option( '_ts_social_media_urls' );
	$suparnova_lite_social_option = (array)$suparnova_lite_social_option;
	$suparnova_lite_social_array = suparnova_lite_social_media_array();
	?>
	<ul class="suparnova-lite-social-menu">
		<?php
			foreach ( $suparnova_lite_social_array as $media => $params ) {
				if( isset( $option[ $media ] ) && !empty( $option[ $media ] ) ) {
					echo sprintf( '<li><a href="%s" class="brand-hover-bg-%s"><i class="%s"></i></a></li>', esc_url( $option[ $media ] ), esc_attr( $media ), esc_attr( $params['icon'] ) );
				}
			}
		?>
	</ul>
</div><!-- .site-info -->