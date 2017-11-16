<?php
/**
 * Shows the logo area of the header
 */

$suparnova_lite_alignment = '';

switch( suparnova_lite_theme_option( 'logo_alignment' ) ) {
	case 'right':
		$suparnova_lite_alignment = ' align-right';
		break;
	case 'center':
		$suparnova_lite_alignment = ' align-center';
		break;
}

?><div class="site-branding<?php echo esc_attr( $suparnova_lite_alignment ); ?>">
	<div class="container">
		<div class="branding-inner">
			<div class="logo-area">
				<div class="site-logo">
					<?php
					if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo();
					} elseif ( get_header_image() ) {
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</a>
						<?php
					} else {
					?>
					<h4 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h4>
					<?php
					$suparnova_lite_description = get_bloginfo( 'description', 'display' );
					if ( $suparnova_lite_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $suparnova_lite_description ); /* WPCS: xss ok. */ ?></p>
					<?php
					endif;
					} ?>
				</div>
			</div>
			<?php
			$suparnova_lite_banner = suparnova_lite_theme_option( 'ad_area' );
			if( !empty( $suparnova_lite_banner ) ) {
				?>
				<div class="banner-area">
					<div class="banner-inner">
						<?php 
						add_filter( 'safe_style_css', 'suparnova_lite_modify_safe_css' );
						echo wp_kses( $suparnova_lite_banner, suparnova_lite_banner_allowed_html() );
						remove_filter( 'safe_style_css', 'suparnova_lite_modify_safe_css' );
						?>
					</div>
				</div>
				<?php
			}
			?>
		</div><!-- .branding-inner -->
	</div><!-- .container -->
</div><!-- .site-branding -->