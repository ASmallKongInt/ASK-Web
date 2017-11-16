<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Meta Boxes Initializer
**/
class ShapeShifter_Admin_Meta_Boxes {
	
	# Vars
		/**
		 * Meta Boxes
		 * 
		 * @var $meta_boxes
		**/
		public $meta_boxes = array();

		/**
		 * Widget Areas
		 * 
		 * @var $widget_areas
		**/
		public $widget_areas = array();

		/**
		 * Icons
		 * 
		 * @var $icons
		**/
		private $icons = array();

		/**
		 * Sidebars Settings
		 * 
		 * @var $sidebars_settings
		**/
		private $sidebars_settings = array();

		/**
		 * Widget Settings
		 * 
		 * @var $widget_settings
		**/
		private $widget_settings = array();
	
	/**
	 * Constructor
	**/
	function __construct() {

		// Add Actions
		$this->add_actions();

		// End Trigger
		shapeshifter_trigger_admin_metaboxes();

	}

		/**
		 * Add Actions
		**/
		function add_actions() {

			// CSS JS Enqueues
			add_action( 'admin_enqueue_scripts', array( $this, 'meta_boxes_enqueue_scripts' ) );

			// Metaboxes Forms
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_meta_box_settings' ) );

		}

			/**
			 * CSS JS Enqueues
			 * 
			 * @param string $hook
			**/
			function meta_boxes_enqueue_scripts( $hook ) {

				if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {

					wp_enqueue_media();

					# CSS
						wp_enqueue_style( 'shapeshifter-meta-boxes' );

					# JS
						wp_enqueue_script( 'shapeshifter-meta-boxes' );

				}

			}
	
	/**
	 * Add Meta Boxes
	 * 
	 * @param string $post_type : Default Empty String ""
	 * @param object $post      : Default Empty String ""
	**/
	function add_meta_boxes( $post_type = '', $post = '' ) {

		if ( empty( $post_type ) ) return;

		// Deactivation of Widget Areas
		add_meta_box(
			SHAPESHIFTER_THEME_PREFIX . 'deactivate-widget-areas-by-hook-meta-box',
			sprintf( esc_html__( '%s Settings for Deactivation of Widget Areas', 'shapeshifter' ), SHAPESHIFTER_THEME_NAME ),
			array( $this, 'settins_to_deactivate_widget_area' ),
			$post_type,
			'advanced',
			'high',
			array()
		);

		// For One Column Page Width Size Check
		add_meta_box(
			SHAPESHIFTER_THEME_PREFIX . 'optional-styles-for-the-page',
			esc_html__( 'Optional Styles', 'shapeshifter' ),
			array( $this, 'optional_styles_for_the_page' ),
			$post_type,
			'side',
			'high',
			array()
		);

	}

	/**
	 * Save Posts
	 * 
	 * @param int $post_id
	**/
	function save_meta_box_settings( $post_id ) {

		// Deactivation of Widget Areas
		$this->save_to_deactivate_widget_area( $post_id );

		// For One Column Page Width Size Check
		$this->save_to_setting_one_column_page_width_size( $post_id );

	}
		// Deactivations of Widget Areas
			/**
			 * Print Meta Box Form for Deactivate Widget Area
			 * 
			 * @param object $post
			 * @param array  $args : Empty Array
			**/
			function settins_to_deactivate_widget_area( $post, $args = array() ) {

				global $wp_registered_sidebars;

				//echo '<pre>'; var_dump( $wp_registered_sidebars ); echo '</pre>';

				# Nonce
					wp_nonce_field( SHAPESHIFTER_THEME_PREFIX . 'save_to_deactivate_widget_area', SHAPESHIFTER_THEME_PREFIX . 'deactivate_widget_area_meta_box_nonce' );

				# Saved Value of Deactivation of Widget Areas
					$deactivate_widget_area = ( 
						is_array( get_post_meta( $post->ID, SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area', true ) )
						? get_post_meta( $post->ID, SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area', true )
						: array()
					);
				
				# Description
					esc_html_e( 'Check the widget areas to Deactivate.', 'shapeshifter' );


				# Form Table Start
					echo '<table id="deactivate-widget-area-table"><tbody>';
					
						foreach( $wp_registered_sidebars as $widget_area_id => $data ) {

							$widget_area_id = esc_attr( $widget_area_id );

							echo '<tr>';

								echo '<th>';
									echo '<label for="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area[' . $widget_area_id . ']' ) . '">';
										echo esc_html( $data[ 'name' ] );
									echo '</label>';
								echo '</th>';

								echo '<td>';
									echo '<input 
										type="checkbox" 
										id="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area[' . $widget_area_id . ']' ) . '" 
										name="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area[' . $widget_area_id . ']' ) . '" 
										value="' . $widget_area_id . '" 
										' . ( in_array( $widget_area_id, $deactivate_widget_area ) ? 'checked' : '' ) . ' 
									/>';
								echo '</td>';
								
							echo '</tr>';

						}

					echo '</tbody></table>';

			}

			/**
			 * Save the Settings
			 * 
			 * @param int $post_id
			**/
			function save_to_deactivate_widget_area( $post_id ) {
				
				// Prepare
					if ( ! isset( $_POST[ SHAPESHIFTER_THEME_PREFIX . 'deactivate_widget_area_meta_box_nonce' ] ) ) {
						return;
					}
				
					if ( ! wp_verify_nonce( $_POST[ SHAPESHIFTER_THEME_PREFIX . 'deactivate_widget_area_meta_box_nonce' ], SHAPESHIFTER_THEME_PREFIX . 'save_to_deactivate_widget_area' ) ) {
						return;
					}
				
					if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
						return;
					}
				
					if ( isset( $_POST[ 'post_type' ] ) && 'page' === $_POST[ 'post_type' ] ) {
				
						if ( ! current_user_can( 'edit_page', $post_id ) ) {
							return;
						}
				
					} else {

						if ( ! current_user_can( 'edit_post', $post_id ) ) {
							return;
						}

					}

				// Update
					$saved_data = array();
					if ( isset( $_POST[ SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area' ] ) 
						&& is_array( $_POST[ SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area' ] )
					) { foreach( $_POST[ SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area' ] as $index => $data ) {

						$data = sanitize_text_field( $data );

						$saved_data[ $data ] = $data;

					} }
					update_post_meta( $post_id, SHAPESHIFTER_THEME_POST_META . 'deactivate_widget_area', $saved_data );
					
			}

		// Optional Styles for the Page
			/**
			 * Meta Box Form
			 * 
			 * @param object $post
			 * @param array  $args : Empty Array
			**/
			function optional_styles_for_the_page( $post, $args = array() ) {

				# Nonce
					wp_nonce_field( SHAPESHIFTER_THEME_PREFIX . 'save_optional_styles_for_the_page', SHAPESHIFTER_THEME_PREFIX . 'optional_styles_for_the_page_nonce' );

				# Form
					$is_one_column_page_width_size_max = (
						get_post_meta( $post->ID, SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max', false ) !== array()
						? get_post_meta( $post->ID, SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max', true )
						: ( 
							get_theme_mod( 'is_one_column_main_content_max_width_on', false )
							? 'is_max_width_size'
							: ''
						)
					);

					echo '<input type="checkbox" name="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max' ) . '" id="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max' ) . '" value="is_max_width_size" ' . checked( $is_one_column_page_width_size_max, 'is_max_width_size', false ) . '>';
					echo '<label for="' . esc_attr( SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max' ) . '">' . esc_html__( 'Make Width Size Maximized only if this page is of One-Column Layout.', 'shapeshifter' ) . '</label>';

			}

			/**
			 * Save the Settings
			 * 
			 * @param int $post_id
			**/
			function save_to_setting_one_column_page_width_size( $post_id ) {

				if ( ! isset( $_POST[ SHAPESHIFTER_THEME_PREFIX . 'optional_styles_for_the_page_nonce' ] ) ) {
					return;
				}
			
				if ( ! wp_verify_nonce( $_POST[ SHAPESHIFTER_THEME_PREFIX . 'optional_styles_for_the_page_nonce' ], SHAPESHIFTER_THEME_PREFIX . 'save_optional_styles_for_the_page' ) ) {
					return;
				}
			
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return;
				}
			
				if ( isset( $_POST[ 'post_type' ] ) && 'page' === $_POST[ 'post_type' ] ) {
			
					if ( ! current_user_can( 'edit_page', $post_id ) ) {
						return;
					}
			
				} else {

					if ( ! current_user_can( 'edit_post', $post_id ) ) {
						return;
					}

				}

				$data = sanitize_text_field( isset( $_POST[ SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max' ] ) ? $_POST[ SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max' ] : '' );
				update_post_meta( $post_id, SHAPESHIFTER_THEME_POST_META . 'is_one_column_page_width_size_max', $data );

			}

}
