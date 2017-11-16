<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skil
 */

$skil_white_logo = get_theme_mod( 'custom_logo' );
$skil_black_logo = get_theme_mod( 'skil_black_site_logo' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="HandheldFriendly" content="true" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="close-menu"></div>
	<nav class="main-menu">
		<div class="main-menu-bg clearfix">
			<?php
				if ( has_nav_menu( 'primary' ) ) {

					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container' 	 => false,
							'items_wrap' 	 => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						));

				} else {

					wp_nav_menu(
						array(
							'container' 	 => false,
							'items_wrap' 	 => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						));

				}
			?>
		</div>
		<div class="social-menu">
			<?php
				if ( has_nav_menu( 'social' ) ) {

					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'container' 	 => false,
							'items_wrap' 	 => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						));

				} else {

					wp_nav_menu(
						array(
							'container' 	 => false,
							'items_wrap' 	 => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						));

				}
			?>
		</div>
	</nav>

	<header class="main-header" itemscope itemtype="<?php echo esc_url('http://schema.org/Organization'); ?>">
		<button class="menu-trigger theme-button">
			<span class="menu-bars">
				<span></span>
				<span></span>
				<span></span>
			</span>
			<span class="txt">
				<?php esc_html_e( 'menu' , 'skil' ); ?>
			</span>
		</button>
		<a href="<?php echo esc_url( home_url() ); ?>" class="main-logo" itemprop="brand" itemscope itemtype="<?php echo esc_url('http://schema.org/Brand'); ?>">
			<span class="logo-table">
				<span class="logo-table-cell">
					<?php if ( $skil_black_logo != '' && $skil_white_logo != '' && display_header_text() == false ): 
					$skil_white_logo = wp_get_attachment_image_src($skil_white_logo, "full"); ?>
					<img itemprop="logo" src="<?php echo esc_url($skil_black_logo); ?>" alt="header-logo">
					<img itemprop="logo" src="<?php echo esc_url($skil_white_logo[0]); ?>" alt="header-logo">
					<?php else: ?>
					<span class="text-logo">
						<?php echo get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ); ?>
					</span>
					<?php endif ?>
				</span>
			</span>
		</a>
	</header>
