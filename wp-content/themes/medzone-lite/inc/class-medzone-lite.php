<?php
/**
 * MedZone_Lite Theme Framework
 *
 * @package MedZone_Lite
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class MedZone_Lite
 */
class MedZone_Lite {

	/**
	 * MedZone_Lite constructor.
	 *
	 * Theme specific actions and filters
	 */
	public function __construct() {
		/**
		 * If PHP Version is older than 5.3, we switch back to default theme
		 */
		add_action( 'admin_init', array( $this, 'php_version_check' ) );
		/**
		 * Backward compatibility
		 */
		add_action( 'admin_init', array( $this, 'backward_compatibility' ) );
		/**
		 * Add a notice for the MachoThemes feedback
		 */
		add_action( 'admin_init', array( $this, 'add_feedback_notice' ) );
		/**
		 * Start theme setup
		 */
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		/**
		 * Enqueue styles and scripts
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueues' ) );
		/**
		 * Customizer enqueues & controls
		 */
		add_action( 'customize_register', array( $this, 'customize_register_init' ) );
		/**
		 * Declare content width
		 */
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 10 );
		/**
		 * Grab all class methods and initiate automatically
		 */
		$methods = get_class_methods( 'MedZone_Lite' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'init_' ) ) {
				$this->$method();
			}
		}
	}

	/**
	 * Adds a feedback notice if conditions are met
	 */
	public function add_feedback_notice() {
		if ( get_user_meta( get_current_user_id(), 'notification_feedback', true ) ) {
			return;
		}

		$page_on_front = 'page' == get_option( 'show_on_front' ) ? true : false;
		$id            = absint( get_option( 'page_on_front', 0 ) );

		if ( $page_on_front && 0 !== $id ) {
			$revisions = wp_get_post_revisions( $id );

			if ( count( $revisions ) > 3 ) {
				/**
				 * Revision keys are ID's, and it's not incremental
				 */
				$first = end( $revisions );

				$revision_time = new DateTime( $first->post_modified );
				$today         = new DateTime( 'today' );
				$interval      = $today->diff( $revision_time )->format( '%d' );

				if ( 2 <= absint( $interval ) ) {
					$this->_notify_feedback();
				}
			}
		}
	}

	/**
	 * Notify of feedback
	 */
	private function _notify_feedback() {
		if ( ! class_exists( 'Epsilon_Notifications' ) ) {
			return;
		}
		$html = '<p>';
		$html .=
			vsprintf(
				// Translators: 1 is Theme Name, 2 is opening Anchor, 3 is closing.
				__( 'We\'ve been working hard on making %1$s the best one out there. We\'re interested in hearing your thoughts about %1$s and what we could do to make it even better. %2$sSend your feedback our way%3$s. <br/> <br/> <strong>Note: A 10%% discount coupon will be emailed to you after form submission. Please use a valid email address.</strong>', 'medzone-lite' ),
				array(
					'MedZone Lite',
					'<a target="_blank" href="https://bit.ly/medzone-feedback">',
					'</a>',
				)
			);

		$notifications = Epsilon_Notifications::get_instance();
		$notifications->add_notice(
			array(
				'id'      => 'notification_feedback',
				'type'    => 'notice epsilon-big',
				'message' => $html,
			)
		);
	}

	/**
	 * Backward compatibility
	 */
	public function backward_compatibility() {
		$theme    = wp_get_theme();
		$version  = $theme->get( 'Version' );
		$backward = get_theme_mod( 'medzone_lite_updated_to_104', false );
		if ( wp_doing_ajax() ) {
			return;
		}

		if ( version_compare( '1.0.4', $version ) >= 0 && ! $backward ) {
			$page = MedZone_Lite_Notify_System::is_not_static_page();
			if ( $page ) {
				$id       = get_option( 'page_on_front' );
				$options  = get_post_meta( Epsilon_Content_Backup::get_instance()->setting_page, 'medzone_lite_frontpage_sections', true );
				$imported = get_theme_mod( 'medzone_lite_content_imported', false );
				if ( $imported ) {
					return;
				}

				$sanitized                                        = array();
				$sanitized[ 'medzone_lite_frontpage_sections_' . $id ] = array();
				foreach ( $options as $k => $v ) {
					$sanitized[ 'medzone_lite_frontpage_sections_' . $id ] = $v;
				};

				update_post_meta(
					$id,
					'medzone_lite_frontpage_sections_' . $id,
					$sanitized
				);

				set_theme_mod( 'medzone_lite_content_imported', true );
				set_theme_mod( 'medzone_lite_updated_to_104', true );
			}
		}
	}

	/**
	 * Check PHP Version and switch theme
	 */
	public function php_version_check() {
		if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
			return true;
		}

		switch_theme( WP_DEFAULT_THEME );

		return false;
	}

	/**
	 * Initiate the epsilon framework
	 */
	public function init_epsilon() {
		new Epsilon_Framework();

		$this->start_typography_controls();
	}

	/**
	 * Initiate the Hooks in MedZone_Lite
	 */
	public function init_hooks() {
		new MedZone_Lite_Hooks();
	}

	/**
	 * Initiate the user profiles
	 */
	public function init_user_profile() {
		new MedZone_Lite_Profile_Fields();
	}

	/**
	 * Loads sidebars and widgets
	 */
	public function init_sidebars() {
		new MedZone_Lite_Sidebars();
	}

	/**
	 * Initiate the setting helper
	 */
	public function customize_register_init() {
		new MedZone_Lite_Customizer();
	}

	/**
	 * Loads the typography controls required scripts
	 */
	public function start_typography_controls() {
		/**
		 * Instantiate the Epsilon Typography object
		 */
		$options = array(
			'medzone_lite_typography_headings',
			'medzone_lite_paragraphs_typography',
		);

		$handler = 'medzone-lite-main';
		Epsilon_Typography::get_instance( $options, $handler );
	}


	/**
	 * Initiate the welcome screen
	 */
	public function init_welcome_screen() {
		// Welcome screen.
		if ( is_admin() ) {
			$plugins = array(
				'kiwi-social-share'        => array(
					'recommended' => false,
				),
				'modula-best-grid-gallery' => array(
					'recommended' => true,
				),
			);

			$importer = Epsilon_Import_Data::get_instance();

			/**
			 *
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$actions = array(
				array(
					'id'          => 'medzone-import-data',
					'title'       => esc_html__( 'Add sample content', 'medzone-lite' ),
					'description' => esc_html__( 'Clicking the button below will add content/sections/settings and recommended plugins to your WordPress installation. Click advanced to customize the import process.', 'medzone-lite' ),
					'help'        => array( Epsilon_Import_Data::get_instance(), 'generate_import_data_container' ),
					'check'       => MedZone_Lite_Notify_System::check_installed_data(),
				),
				array(
					'id'          => 'medzone-check-cf7',
					'title'       => MedZone_Lite_Notify_System::plugin_verifier( 'contact-form-7', 'title', 'Contact Form 7', 'verify_cf7' ),
					'description' => MedZone_Lite_Notify_System::plugin_verifier( 'contact-form-7', 'description', 'Contact Form 7', 'verify_cf7' ),
					'plugin_slug' => 'contact-form-7',
					'check'       => defined( 'WPCF7_VERSION' ),
				),
			);

			if ( is_customize_preview() ) {
				$url                = 'themes.php?page=%1$s-welcome&tab=%2$s';
				$actions[0]['help'] = '<a class="button button-primary" id="" href="' . esc_url( admin_url( sprintf( $url, 'medzone-lite', 'recommended-actions' ) ) ) . '">' . __( 'Import Demo Content', 'medzone-lite' ) . '</a>';
			}

			$config = array(
				'theme-name' => 'MedZone Lite',
				'theme-slug' => 'medzone-lite',
				'actions'    => $actions,
				'plugins'    => $plugins,

			);

			Epsilon_Welcome_Screen::get_instance( $config );

		}// End if().
	}

	/**
	 * Register Scripts and Styles for the theme
	 */
	public function enqueues() {
		$theme = wp_get_theme();
		/**
		 * Register scripts
		 */
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/vendors/font-awesome/css/font-awesome.min.css' );
		wp_register_script( 'superfish-hoverIntent', get_template_directory_uri() . '/assets/vendors/superfish/hoverIntent.min.js', array(), $theme['Version'], true );
		wp_register_script( 'superfish', get_template_directory_uri() . '/assets/vendors/superfish/superfish.min.js', array(), $theme['Version'], true );
		wp_register_script( 'bxslider', get_template_directory_uri() . '/assets/vendors/bxslider/jquery.bxslider.min.js', array(), $theme['Version'], true );
		wp_register_style( 'bxslider', get_template_directory_uri() . '/assets/vendors/bxslider/jquery.bxslider.css' );
		wp_register_style( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.css' );
		wp_register_script( 'slick', get_template_directory_uri() . '/assets/vendors/slick/slick.min.js', array(), $theme['Version'], true );
		wp_register_script( 'stickem', get_template_directory_uri() . '/assets/vendors/stickem/jquery.stickem.js', array(), $theme['Version'], true );
		wp_register_script( 'offscreen', get_template_directory_uri() . '/assets/vendors/offscreen/offscreen.min.js', array(), $theme['Version'], true );
		/**
		 * Google fonts
		 */
		wp_enqueue_style( 'medzone-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400|Poppins:300,400,600', array(), $theme['Version'], 'all' );

		/**
		 * Load stylesheet
		 */
		wp_enqueue_style( 'medzone-lite', get_stylesheet_uri() );
		wp_enqueue_style(
			'medzone-lite-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array(
				'font-awesome',
				'bxslider',
				'slick',
				'medzone-lite',
			),
			$theme['Version']
		);

		wp_enqueue_style( 'medzone-style-overrides', get_template_directory_uri() . '/assets/css/overrides.css' );

		/**
		 * Load scripts
		 */
		wp_enqueue_script(
			'medzone-lite-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(
				'jquery',
				'superfish-hoverIntent',
				'superfish',
				'bxslider',
				'slick',
				'stickem',
				'offscreen',
			),
			$theme['Version'],
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * MedZone_Lite Theme Setup
	 */
	public function theme_setup() {
		/**
		 * Load theme text-domain
		 */
		load_theme_textdomain( 'medzone-lite', get_template_directory() . '/languages' );
		/**
		 * Load framework text-domain
		 */
		load_textdomain( 'epsilon-framework', '' );
		/**
		 * Load menus
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Navigation', 'medzone-lite' ),
				'footer'  => esc_html__( 'Footer Navigation', 'medzone-lite' ),
			)
		);

		/**
		 * Theme supports
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'custom-logo',
			array(
				'height'     => 35,
				'width'      => 130,
				'flex-width' => true,
			)
		);
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'quote',
				'link',
				'gallery',
				'video',
				'status',
				'audio',
				'chat',
			)
		);
		add_theme_support(
			'custom-header',
			array(
				'width'              => 1920,
				'height'             => 400,
				'flex-height'        => true,
				'flex-width'         => true,
				'default-text-color' => '',
				'header-text'        => false,
				'uploads'            => true,
				'video'              => false,
			)
		);

		/**
		 * Image sizes
		 */
		add_image_size( 'medzone-blog-image', 1140, 760, true );
		add_image_size( 'medzone-hospital-slider', 1100, 500, true );
		add_image_size( 'medzone-doctor-portrait', 500, 700, true );
		add_image_size( 'medzone-testimonial-portrait', 260, 300, true );
	}

	/**
	 * Content width
	 */
	public function content_width() {
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 600;
		}
	}
}
