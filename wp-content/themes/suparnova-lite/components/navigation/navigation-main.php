<?php
/**
 * Shows the main menu area of the header
 */
$suparnova_lite_color_class = '';
$suparnova_lite_hover_class = '';

if( 'dark' === suparnova_lite_theme_option( 'menu_color' ) ) {
	$suparnova_lite_color_class = ' dark-colors';
}

if( 'dark' === suparnova_lite_theme_option( 'menu_sub_color' ) ) {
	$suparnova_lite_hover_class = ' dark-hover';
}

$suparnova_lite_menu_alignment = '';

switch ( suparnova_lite_theme_option( 'menu_alignment' ) ) {
	case 'right':
		$suparnova_lite_menu_alignment = ' align-right';
		break;
	case 'center':
		$suparnova_lite_menu_alignment = ' align-center';
		break;
}
?><nav id="site-navigation" class="main-navigation<?php echo esc_attr( $suparnova_lite_color_class . $suparnova_lite_menu_alignment ); ?>" role="navigation">
	<div class="container">
		<div class="desktop-menu<?php echo esc_attr( $suparnova_lite_hover_class ); ?>">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id' => 'top-menu',
				'container_class' => 'menu-root',
				'fallback_cb' => 'suparnova_lite_fallback_menu',
			) ); ?>
		</div>
		<button class="menu-toggle menu-toggle-bars collapsed" data-toggle="collapse" data-target="#main-menu-mobile" aria-controls="mobile-menu" aria-expanded="false">
			<span class="bar"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'suparnova-lite' ); ?></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</button>
		<?php if( !suparnova_lite_theme_option( 'header_search' ) ) { ?>
		<div class="suparnova-lite-header-search">
			<a href="#header-search" data-toggle="collapse" class="search-toggle"><i class="fa fa-search"></i></a>
			<div class="search-container collapse" id="header-search">
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php } ?>
		<div id="main-menu-mobile" class="mobile-menu collapse">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id' => 'top-menu',
				'container_class' => 'menu-root',
				'fallback_cb' => 'suparnova_lite_fallback_menu',
			) ); ?>
		</div>
	</div>
</nav>
