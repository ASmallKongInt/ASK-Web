<?php
/**
 * Floral functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Floral
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function floral_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Floral, use a find and replace
	 * to change 'floral-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'floral-lite', get_template_directory() . '/languages' );

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
	add_image_size( 'floral-recent', 90, 90, true );
	add_image_size( 'floral-featured', 580, 386, true );
	set_post_thumbnail_size( 770, 500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'floral-lite' ),
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
	add_theme_support( 'custom-background', apply_filters( 'floral_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support( 'custom-logo' );

	// Post format.
	add_theme_support( 'post-formats',
		array(
			'video',
			'audio',
			'quote',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'floral_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function floral_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'floral_content_width', 770 );
}
add_action( 'after_setup_theme', 'floral_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function floral_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'floral-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'floral-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	require_once get_template_directory() . '/inc/widgets/class-floral-recent-posts-widget.php';
	register_widget( 'Floral_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'floral_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function floral_scripts() {
	wp_enqueue_style( 'floral-fonts', floral_fonts_url() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', '', '4.5.0' );
	wp_enqueue_style( 'floral-style', get_stylesheet_uri() );

	wp_enqueue_script( 'floral-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'floral-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), '1.6.0', true );
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array( 'jquery' ), '1.5.0', true );

	wp_enqueue_script( 'floral-script', get_template_directory_uri() . '/js/script.js', array(
		'slick-js',
		'theia-sticky-sidebar',
	), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'floral_scripts' );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function floral_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'floral-lite' ) ) {
		$fonts[] = 'Playfair Display:400,400i,700,700i,900,900i';
	}
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'floral-lite' ) ) {
		$fonts[] = 'Open Sans:400,400i,700,700i';
	}

	$fonts_url = add_query_arg( array(
		'family' => rawurlencode( implode( '|', $fonts ) ),
		'subset' => rawurlencode( $subsets ),
	), 'https://fonts.googleapis.com/css' );

	return $fonts_url;
}

/**
 * Add editor style.
 */
function floral_add_editor_styles() {
	add_editor_style( array(
		'css/editor-style.css',
		floral_fonts_url(),
		get_template_directory_uri() . '/css/font-awesome.min.css',
	) );
}
add_action( 'init', 'floral_add_editor_styles' );

/**
 * Add notice after active theme.
 */
function floral_notice() {
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
	?>
	<div class="updated notice notice-success is-dismissible">
		<p>
			<?php
			// Translators: welcome page.
			echo wp_kses_post( sprintf( __( 'Thank you for choosing Floral Lite. To get started, visit our <a href="%s">welcome page</a>.', 'floral-lite' ), esc_url( admin_url( 'themes.php?page=floral-lite' ) ) ) );
			?>
		</p>
	</div>
	<?php
	}
}
add_action( 'admin_notices', 'floral_notice' );

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load dashboard
 */
require get_template_directory() . '/inc/dashboard/class-floral-dashboard.php';
$dashboard = new Floral_Dashboard;

