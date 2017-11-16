<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Floral
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'floral-lite' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-content">
			<div class="header-content__container container">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'floral-lite' ); ?></button>
					<?php wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id' => 'primary-menu',
					) ); ?>
				</nav><!-- #site-navigation -->

				<?php if ( function_exists( 'jetpack_social_menu' ) ) : ?>
					<?php jetpack_social_menu(); ?>
				<?php endif; ?>

				<div class="header-search">
					<button class="header-search__click">
						<i class="fa fa-search"></i>
						<span class="screen-reader-text"><?php esc_attr_e( 'Open Search Popup', 'floral-lite' ); ?></span>
					</button>
					<div class="header-search__wrapper">
						<?php get_search_form(); ?>
						<button class="header-search__click header-search__close">
							<i class="fa fa-close"></i>
							<span class="screen-reader-text"><?php esc_attr_e( 'Close Search Popup', 'floral-lite' ); ?></span>
						</button>
					</div>
				</div><!-- .header-search -->
			</div>
		</div><!-- .header-content -->

		<div class="site-branding container">
			<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php endif; ?>
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
			endif; ?>
		</div><!-- .logo -->
	</header><!-- #masthead -->
	<?php
	// Display featured posts on the homepage.
	if ( is_front_page() ) {
		get_template_part( 'template-parts/featured-content' );
	}
	?>

	<div id="content" class="site-content container">
