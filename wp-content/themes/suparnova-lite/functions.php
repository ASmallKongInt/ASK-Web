<?php
/**
 * Suparnova functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Suparnova
 */

if ( ! function_exists( 'suparnova_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function suparnova_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'suparnova-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'suparnova-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'suparnova-lite-featured-image', 640, 9999 );
	add_image_size( 'suparnova-lite-thumbnail', 960, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'suparnova-lite' ),
		'menu-2' => esc_html__( 'Top Left Menu', 'suparnova-lite' ),
		'menu-3' => esc_html__( 'Top Right Menu', 'suparnova-lite' ),
		'menu-4' => esc_html__( 'Footer Menu', 'suparnova-lite' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'suparnova_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'suparnova_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function suparnova_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'suparnova_lite_content_width', 1170 );
}
add_action( 'after_setup_theme', 'suparnova_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function suparnova_lite_widgets_init() {
	register_widget( 'Suparnova_Lite_Categories' );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 1 (Primary)', 'suparnova-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Default sidebar that shows on right side.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 2 (Optional)', 'suparnova-lite' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Default sidebar that shows on left side.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 1', 'suparnova-lite' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets for footer from here.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 2', 'suparnova-lite' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets for footer from here.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 3', 'suparnova-lite' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets for footer from here.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets 4', 'suparnova-lite' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets for footer from here.', 'suparnova-lite' ),
		'before_widget' => '<section id="%1$s" class="widget heading-hover %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="suparnova-lite-heading"><span>',
		'after_title'   => '</span></h4>',
	) );
}
add_action( 'widgets_init', 'suparnova_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function suparnova_lite_scripts() {
	
	wp_enqueue_style( 'suparnova-lite-google-fonts', suparnova_lite_fonts_url() );
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css' );

	$css_skin_uri = get_template_directory_uri() . '/assets/css/skins/default.css';

	switch ( suparnova_lite_theme_option( 'site_color' ) ) {
		case 'green':
			$css_skin_uri = get_template_directory_uri() . '/assets/css/skins/green.css';
			break;
		case 'blue':
			$css_skin_uri = get_template_directory_uri() . '/assets/css/skins/blue.css';
			break;
		case 'purple':
			$css_skin_uri = get_template_directory_uri() . '/assets/css/skins/purple.css';
			break;
	}
	
	wp_enqueue_style( 'suparnova-lite-style', $css_skin_uri );

	wp_enqueue_style( 'suparnova-brand-styles', get_template_directory_uri() . '/assets/css/brands.css' );
	
	wp_add_inline_style( 'suparnova-lite-style', suparnova_lite_inline_css() );

	wp_enqueue_script( 'suparnova-lite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20170715', true );
	
	wp_enqueue_script( 'jquery-swiper', get_template_directory_uri() . '/assets/js/swiper.jquery.js', array('jquery'), '20170715', true );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '20170715', true );
	
	wp_enqueue_script( 'suparnova-lite-scripts', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20170715', true );

	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'suparnova_lite_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/class-suparnova-customizer-api.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

$suparnova_lite_disable_schema = suparnova_lite_theme_option( 'enable_schema' );

suparnova_lite_global_set( 'suparnova_lite_disable_schema_markup', empty( $suparnova_lite_disable_schema ) );
suparnova_lite_global_set( 'suparnova_lite_blog_layout_size', 'md' );