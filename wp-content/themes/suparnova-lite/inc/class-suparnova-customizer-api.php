<?php
/**
 * Minimo Theme Customizer API.
 *
 * @package Suparnova
 */

if( ! class_exists( 'Suparnova_Lite_Customizer_API' ) ) :
class Suparnova_Lite_Customizer_API {
	
	public $template;
	public $direct_sections;
	
	public function __construct( $template = array(), $args = array() ) {
		
		$args = wp_parse_args( $args, array(
			'direct' => false,
			'in_array' => false,
			'transport' => 'postMessage',
			'type' => 'option',
			'sanatize' => '',
			'prefix' => '',
		) );
			
		$this->template = $template;
		$this->direct_sections = $args['direct'];
		$this->in_array = $args['in_array'];
		$this->default_transport = $args['transport'];
		$this->default_type = $args['type'];
		$this->sanatize = $args['sanatize'];
		$this->prefix = $args['prefix'];
		
		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'wp', array( $this, 'place_defaults' ) );
		
	}
	
	/**
	 * Place defaults to global variables
	 */
	public function place_defaults() {
		
		$template = $this->template;
		$sections = $this->direct_sections;
		
		if( $sections ) {
			$this->add_defaults( $template );
		} else {
			foreach( $template as $panel => $args ) {				
				$this->add_defaults( $args['sections'] );				
			}
		}
		
	}
	
	/**
	 * Check and update default to a global variable for later use
	 */
	public function add_defaults( $template ) {

		global $suparnova_lite_default_options;
		
		foreach( $template as $fields ) {
			
			foreach( $fields['fields'] as $field => $args ) {

				if( !isset( $args['setting'] ) ) {
					$args['setting'] = array();
				}

				if( !isset( $args['setting']['default'] ) ) {
					$args['setting']['default'] = '';
				}
			
				if( !isset( $args['setting']['type'] ) ) {
					$args['setting']['type'] = $this->default_type;
				}

				if( isset( $args['sanitize'] ) ) {
					$args['setting']['sanitize_callback'] = $args['sanitize'];
				}

				if( isset( $args['setting']['sanitize'] ) ) {
					$args['setting']['sanitize_callback'] = $args['setting']['sanitize'];
					unset( $args['setting']['sanitize'] );
				}

				if( !isset( $args['setting']['sanitize_callback'] ) ) {
					$sanatize = ( ! empty( $this->sanatize ) ) ? $this->sanatize : array( $this, 'def_sanitize' );
					$args['setting']['sanitize_callback'] = $sanatize;
				}

				if( $args['control']['type'] == 'checkbox' ) {
					$args['setting']['sanitize_callback'] = array( $this, 'checkbox_sanitize' );
				}

				$default = call_user_func( $args['setting']['sanitize_callback'], $args['setting']['default'] );

				(array)$suparnova_lite_default_options[ $field ] = $default;

			}
		}
		
	}
	
	public function register( $wp_customize ) {
		
		$template = $this->template;
		$sections = $this->direct_sections;
		
		if( $sections ) {
			$this->add_sections( $wp_customize, $template );
		} else {
			foreach( $template as $panel => $args ) {
				
				$panel_sections = $args['sections'];
				
				unset( $args['sections'] );
				
				if( ! $wp_customize->get_panel( $panel ) ) {
					$wp_customize->add_panel( $panel, $args );
				}
				
				$this->add_sections( $wp_customize, $panel_sections, $panel );
				
			}
		}
		
	}
	
	public function add_sections( $wp_customize, $template, $panel = '' ) {
		
		foreach( $template as $section => $args ) {
			
			$fields = $args['fields'];
			unset( $args['fields'] );
			
			if( !empty( $panel ) ) {
				$args['panel'] = $panel;
			}
				
			if( ! $wp_customize->get_section( $section ) ) {
				$wp_customize->add_section( $section, $args );
			}
			
			$this->add_fields( $wp_customize, $fields, $section );
		}
		
	}
	
	public function add_fields( $wp_customize, $template, $section = '' ) {

		foreach( $template as $field => $args ) {

			$prefix = isset( $args['prefix'] ) ? isset( $args['prefix'] ) : $this->prefix;

			if( $this->in_array && !empty( $prefix ) ) {
				$field = $prefix . '[' . $field . ']';
			} else {
				$field = $prefix . $field;
			}
			
			if( !isset( $args['setting'] ) ) {
				$args['setting'] = array();
			}
			
			if( !isset( $args['setting']['default'] ) ) {
				$args['setting']['default'] = '';
			}
			
			if( !isset( $args['setting']['transport'] ) ) {
				$args['setting']['transport'] = $this->default_transport;
			}
			
			if( !isset( $args['setting']['type'] ) ) {
				$args['setting']['type'] = $this->default_type;
			}
			
			if( isset( $args['sanitize'] ) ) {
				$args['setting']['sanitize_callback'] = $args['sanitize'];
			}
			
			if( isset( $args['setting']['sanitize'] ) ) {
				$args['setting']['sanitize_callback'] = $args['setting']['sanitize'];
				unset( $args['setting']['sanitize'] );
			}
			
			if( !isset( $args['setting']['sanitize_callback'] ) ) {
				$sanatize = ( ! empty( $this->sanatize ) ) ? $this->sanatize : array( $this, 'def_sanitize' );
				$args['setting']['sanitize_callback'] = $sanatize;
			}
			
			if( $args['control']['type'] == 'checkbox' ) {
				$args['setting']['sanitize_callback'] = array( $this, 'checkbox_sanitize' );
			}
				
			if( ! $wp_customize->get_setting( $field ) ) {
				// Make themecheck happy
				$sanitize = $args['setting']['sanitize_callback'];
				unset( $args['setting']['sanitize_callback'] );
				$wp_customize->add_setting( $field, array_merge( $args['setting'], array( 'sanitize_callback' => $sanitize ) ) );
			}
			
			$args['control']['section'] = $section;
				
			if( ! $wp_customize->get_control( $field ) ) {
				
				if( $args['control']['type'] == 'media' ) {
					
					unset( $args['control']['type'] );
					
					if( !isset( $args['control']['mime_type'] ) ) {
						$args['control']['mime_type'] = 'image';
					}
					
					if( $args['control']['mime_type'] == 'image' && isset( $args['control']['height'] ) && isset( $args['control']['width'] ) ) {
						$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $field, $args['control'] ) );
					} else {
						$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $field, $args['control'] ) );
					}
					
				} else {
					$wp_customize->add_control( $field, $args['control'] );
				}
			}
			
			if( isset( $args['partial'] ) ) {
				if( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial( $field, $args['partial'] );
				} else {
					$wp_customize->get_setting( $field )->transport = 'refresh';
				}
			}
			
		}
		
	}
	
	public function checkbox_sanitize( $value ) {
		if( empty( $value ) ) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public function def_sanitize( $value ) {
		return wp_kses_post( $value );
	}
	
}
endif;