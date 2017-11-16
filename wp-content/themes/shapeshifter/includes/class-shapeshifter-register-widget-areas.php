<?php
// Check if This is read by WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Widget Areas
 * 
 * 
**/
class ShapeShifter_Register_Widget_Areas {

	// Vars
		/**
		 * Widget Areas Data
		 * 
		 * @var $standard_widget_areas
		**/
		private static $standard_widget_areas = array();

	/**
	 * Constructor
	**/
	function __construct() {

		// Define
			// Standard Widget Areas
			self::$standard_widget_areas = array(
				'slidebar_left' => array(
					'id' => 'slidebar_left',
					'class' => 'slidebar_left',
					'name' => esc_html__( 'Slidebar Left', 'shapeshifter' ),
					'description' => esc_html__( 'Slidebar located on the left of the window. This widget area is NOT Displayed in Mobile. When Theme Customizer Setting "Is Responsive ON" is checked, You can pull the Slidebar in Responsive One Column Style because of Narrower Window.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-slidebar-left-li"><div class="shapeshifter-widget-area-li-div widget-area-slidebar-left-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-slidebar-left-p"><span>',
					'after_title' => '</span></p>',
				),
				'sidebar_left' => array(
					'id' => 'sidebar_left',
					'class' => 'sidebar_left',
					'name' => esc_html__( 'Sidebar Left', 'shapeshifter' ),
					'description' => esc_html__( 'Sidebar located on the left of the main content. This widget area is NOT Displayed in Mobile.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-sidebar-left-li"><div class="shapeshifter-widget-area-li-div widget-area-sidebar-left-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-sidebar-left-p"><span>',
					'after_title' => '</span></p>',
				),
				'sidebar_left_fixed' => array(
					'id' => 'sidebar_left_fixed',
					'class' => 'sidebar_left_fixed',
					'name' => esc_html__( 'Sidebar Left Fixed', 'shapeshifter' ),
					'description' => esc_html__( 'Sidebar located below Sidebar Left that can be fixed. This widget area is NOT Displayed in Mobile.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-sidebar-left-fixed-li"><div class="shapeshifter-widget-area-li-div widget-area-sidebar-left-fixed-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-sidebar-left-fixed-p"><span>',
					'after_title' => '</span></p>',
				),
				'slidebar_right' => array(
					'id' => 'slidebar_right',
					'class' => 'slidebar_right',
					'name' => esc_html__( 'Slidebar Right', 'shapeshifter' ),
					'description' => esc_html__( 'Slidebar located on the right of the window. This widget area is NOT Displayed in Mobile. When Theme Customizer Setting "Is Responsive ON" is checked, You can pull the Slidebar in Responsive One Column Style because of Narrower Window.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-slidebar-right-li"><div class="shapeshifter-widget-area-li-div widget-area-slidebar-right-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-slidebar-right-p"><span>',
					'after_title' => '</span></p>',
				),
				'sidebar_right' => array(
					'id' => 'sidebar_right',
					'class' => 'sidebar_right',
					'name' => esc_html__( 'Sidebar Right', 'shapeshifter' ),
					'description' => esc_html__( 'Sidebar located on the right of the main content. This widget area is NOT Displayed in Mobile.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-sidebar-right-li"><div class="shapeshifter-widget-area-li-div widget-area-sidebar-right-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-sidebar-right-p"><span>',
					'after_title' => '</span></p>',
				),
				'sidebar_right_fixed' => array(
					'id' => 'sidebar_right_fixed',
					'class' => 'sidebar_right_fixed',
					'name' => esc_html__( 'Sidebar Right Fixed', 'shapeshifter' ),
					'description' => esc_html__( 'Sidebar located below Sidebar Right that can be fixed. This widget area is NOT Displayed in Mobile.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-sidebar-right-fixed-li"><div class="shapeshifter-widget-area-li-div widget-area-sidebar-right-fixed-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-sidebar-right-fixed-p"><span>',
					'after_title' => '</span></p>',
				),
				'mobile_sidebar' => array(
					'id' => 'mobile_sidebar',
					'class' => 'mobile_sidebar',
					'name' => esc_html__( 'Mobile Slidebar', 'shapeshifter' ),
					'description' => esc_html__( 'This is the Slidebar on Right Side which is displayed ONLY in Mobile Page. This Area Shows and Hides when Button "Widget" at the bottom is clicked.', 'shapeshifter' ),
					'before_widget' => '<li class="shapeshifter-widget-area-li widget-area-mobile-sidebar-li"><div class="shapeshifter-widget-area-li-div widget-area-mobile-sidebar-li-div widget %s">',
					'after_widget' => '</div></li>',
					'before_title' => '<p class="widget-area-mobile-sidebar-p"><span>',
					'after_title' => '</span></p>',
				),
			); 

		// Actions
			// Register Widget Areas
			add_action( 'widgets_init', array( __CLASS__, 'register_widget_areas' ) );

		// End Hook for Plugins
		// action hook "shapeshifter_trigger_register_widget_areas"
		shapeshifter_trigger_register_widget_areas();

	}

	/**
	 * Register Widget Areas
	**/
	public static function register_widget_areas() {

		// Standard Widget Areas
		foreach( self::$standard_widget_areas as $id => $data )
			register_sidebar( $data );

	}

	/**
	 * Register Widget Areas
	**/
	public static function get_registered_widget_areas() {
		return self::$standard_widget_areas;
	}

}

