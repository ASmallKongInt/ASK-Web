<?php
/**
 * skil functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package skil
 */

if ( !defined( 'SKIL_THEMEROOT' ) ) {
	define('SKIL_THEMEROOT', get_template_directory_uri());
}

if ( !defined( 'SKIL_THEMEDIR' ) ) {
	define('SKIL_THEMEDIR', get_template_directory());
}

if ( ! function_exists( 'skil_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function skil_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on skil, use a find and replace
	 * to change 'skil' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'skil', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'skil' ),
		'social' => esc_html__( 'Social', 'skil' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'skil_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'skil_setup' );

function skil_custom_comment__form($skil_commenter,$skil_req) {

	global $user_identity;

	$skil_aria_req = ( $skil_req ? " aria-required='true'" : '' );

	$skil_fields =  array(
		'author' => '<input id="author" name="author" type="text" value="' . esc_attr($skil_commenter['comment_author']) . '" ' . esc_attr($skil_aria_req) . ' placeholder="' . esc_html__('Your Name', 'skil') . '" />',
		'email' => '<input id="email" name="email" type="text" value="' . esc_attr($skil_commenter['comment_author_email']) . '" ' . esc_attr($skil_aria_req) . ' placeholder="' . esc_html__('Your Email', 'skil') . '"/>',
		'website' => '<input id="website" name="website" type="text" value="' . esc_attr($skil_commenter['comment_author_email']) . '" ' . esc_attr($skil_aria_req) . ' placeholder="' . esc_html__('Your Website', 'skil') . '"/>',
		'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" ' .
								'placeholder="' . esc_html__('Your comment', 'skil') . '"/>' .
						   '</textarea>',
	);

	$skil_args = array(
		'id_form'					 => 'commentform',
		'id_submit'				 => 'submit',
		'class_submit'			=> 'submit',
		'name_submit'			 => 'submit',
		'title_reply'			 => esc_html__( 'Leave me comment' , 'skil' ),
		'title_reply_to'		=> esc_html__( 'Leave a comment to %s' , 'skil' ),
		'cancel_reply_link' => esc_html__( 'Cancel Reply', 'skil' ),
		'label_submit'			=> esc_html__( 'post' , 'skil' ),
		'format'						=> 'xhtml',
		'comment_field' =>	'',
		'comment_notes_before' => '',
		'fields' => apply_filters( 'comment_form_default_fields', $skil_fields ),
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( esc_html__('Logged in as ', 'skil') . '<a href="%1$s">%2$s</a>. <a href="%3$s" title="' . esc_html__('Log out of this account ', 'skil') . '">' . esc_html__('Log out?', 'skil') . '</a>', esc_url(admin_url( 'profile.php' )), $user_identity, esc_url(wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )) ) . '</p>' . $skil_fields['comment_field']
	);

	comment_form( $skil_args );

}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function skil_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'skil_content_width', 640 );
}
add_action( 'after_setup_theme', 'skil_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skil_widgets_init() {
	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'skil' ),
		'id'			=> 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'skil' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'		  => esc_html__( 'Footer', 'skil' ),
		'id'			=> 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'skil' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'skil_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function skil_scripts() {

	// SKIL js files
	wp_enqueue_script('skil-bootstrap-js', SKIL_THEMEROOT . '/assets/bootstrap-master/assets/javascripts/bootstrap.js', array('jquery'), '1.0', true);
	wp_enqueue_script('skil-fit-vids', SKIL_THEMEROOT . '/assets/js/jquery.fitvids.js', array('jquery'), '1.0', true);
	wp_enqueue_script('ski-magnific-popup', SKIL_THEMEROOT . '/assets/js/jquery.magnific-popup.js', array('jquery'), '1.0', true);
	wp_enqueue_script('skil-main', SKIL_THEMEROOT . '/assets/js/main.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'skil-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// SKIL css files
	wp_enqueue_style( 'skil-master', SKIL_THEMEROOT . '/assets/css/master.css');
	wp_enqueue_style( 'skil-style', get_stylesheet_uri() );

}

add_action( 'wp_enqueue_scripts', 'skil_scripts' );

function skil_logo_setup() {
	add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'skil_logo_setup' );

/*
Register Fonts
*/
function skil_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on', 'skil' ) ) {
        $font_url = add_query_arg(
        	'family',
        	urlencode( 'Oswald:400,300,700|Merriweather:400,300,700|Playfair Display:400,700|Ek Mukta|Material Icons' ),
        	"//fonts.googleapis.com/css"
        );
    }
    return $font_url;
}

/*
Enqueue scripts and styles.
*/
function skil_fonts_scripts() {
    wp_enqueue_style( 'skil-fonts', skil_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'skil_fonts_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
