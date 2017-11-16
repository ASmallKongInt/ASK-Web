<?php
# Check if This is read by WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'ShapeShifter_Admin' ) ) {

/**
 * Admin Initializer
**/
class ShapeShifter_Admin {

	# Vars
		/**
		 * Options
		 * 
		 * @var $options
		**/
		public $options = array();

		/**
		 * Holder
		 * 
		 * @var $holder
		**/
		public $holder = array();

	/**
	 * Constructor
	**/
	function __construct() {

		// End Trigger
		shapeshifter_trigger_admin();

	}

} // End Closure

}