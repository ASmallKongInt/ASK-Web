<?php
/**
 * MedZone_Lite Theme Customizer repeatable sections
 *
 * @package MedZone_Lite
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class MedZone_Lite_Repeatable_Sections
 */
class MedZone_Lite_Repeatable_Sections {
	/**
	 * Holds the sections
	 *
	 * @var array
	 */
	public $sections = array();

	/**
	 * MedZone_Lite_Repeatable_Sections constructor.
	 */
	public function __construct() {
		$this->collect_sections();
	}

	/**
	 * Grab an instance of the sections
	 *
	 * @return MedZone_Lite_Repeatable_Sections
	 */
	public static function get_instance() {
		static $inst;
		if ( ! $inst ) {
			$inst = new MedZone_Lite_Repeatable_Sections();
		}

		return $inst;
	}

	/**
	 * Create the section array
	 */
	public function collect_sections() {
		$methods = get_class_methods( 'MedZone_Lite_Repeatable_Sections' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'repeatable_' ) ) {
				$section = $this->$method();

				if ( ! empty( $section ) ) {
					$this->sections[ $section['id'] ] = $section;
				}
			}
		}

		$this->sections = apply_filters( 'medzone_lite_section_collection', $this->sections );
	}

	/**
	 * Create the repeatable hero section array
	 *
	 * @return array
	 */
	private function repeatable_hero() {
		return array(
			'id'          => 'hero',
			'title'       => esc_html__( 'Hero Section', 'medzone-lite' ),
			'description' => esc_html__( 'Section that contains a background image, with call to action texts.', 'medzone-lite' ),
			'fields'      => array(
				'hero_cta'              => array(
					'label'             => esc_html__( 'Call to action', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => esc_html__( 'Best Medical Care you can get for you and your family.', 'medzone-lite' ),
				),
				'hero_small'            => array(
					'label'             => esc_html__( 'Call to action subtext', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => esc_html__( 'More than 3000 specialists are here for you', 'medzone-lite' ),
				),
				'hero_background_color' => array(
					'label'      => esc_html__( 'Background color', 'medzone-lite' ),
					'type'       => 'epsilon-color-picker',
					'defaultVal' => '#f9f9fa',
					'default'    => '#f9f9fa',
				),
				'hero_background'       => array(
					'label' => esc_html__( 'Background image', 'medzone-lite' ),
					'type'  => 'epsilon-image',
				),
				/**
				 * Service Fields
				 */
				'hero_navigation'       => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_cta_services',
					'navigateToLabel' => esc_html__( 'Call To Action Services &rarr;', 'medzone-lite' ),
				),
				'hero_repeater_field'   => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_cta_services',
				),
			),
		);
	}

	/**
	 * Repeatable section builder
	 *
	 * @return array
	 */
	private function repeatable_about() {
		return array(
			'id'          => 'about',
			'title'       => esc_html__( 'About Us Section', 'medzone-lite' ),
			'description' => esc_html__( 'General information section.', 'medzone-lite' ),
			'fields'      => array(
				'about_title'          => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => wp_kses_post( 'Watch our impact in the <br>pacient\'s live' ),
				),
				'about_description'    => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p>We are a a full-service, non-profit community hospital, offering comprehensive medical, surgical and therapeutic services. With 281 beds, more than 1900 employees and a world-class medical staff, we provide innovative, technologically advanced care on a patient-friendly, just north of Seattle.</p><p><a class="btn" href="#">More</a></p>' ),
				),
				'about_image'          => array(
					'label'   => esc_html__( 'Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'default' => '',
				),
				'about_grouping'       => array(
					'label'    => esc_html__( 'About info to show', 'medzone-lite' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => MedZone_Lite_Helper::get_group_values_from_meta( 'medzone_lite_about_info', 'info_title' ),
					'default'  => 'all',
				),
				/**
				 * Service Fields
				 */
				'about_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_about_info',
					'navigateToLabel' => esc_html__( 'Add Information &rarr;', 'medzone-lite' ),
				),
				'about_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_about_info',
				),
			),
		);
	}

	/**
	 * Create specialties section
	 *
	 * @return array
	 */
	private function repeatable_specialties() {
		return array(
			'id'          => 'specialties',
			'title'       => esc_html__( 'Specialties Section', 'medzone-lite' ),
			'description' => esc_html__( 'Displays your hospital specialties in a nicely designed list.', 'medzone-lite' ),
			'fields'      => array(
				/**
				 * This is the main specialty group
				 */
				'main_specialty_title'       => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'text',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => wp_kses_post( 'Main Specialities' ),
				),
				'main_specialty_subtitle'    => array(
					'label'   => esc_html__( 'Subtitle', 'medzone-lite' ),
					'type'    => 'text',
					'default' => wp_kses_post( 'We value our patients' ),
				),
				'main_specialty_description' => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p>MedZone_Lite provides complete medical and surgical services in both inpatient and outpatient settings, at in several convenient locations.</p><p><a href="#">See all Specialities <i class="fa fa-angle-down"></i></a></p>' ),
				),
				'specialties_grouping'       => array(
					'label'    => esc_html__( 'Specialties to show', 'medzone-lite' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => MedZone_Lite_Helper::get_group_values_from_meta( 'medzone_lite_specialties', 'specialties_title' ),
					'default'  => 'all',
				),
				/**
				 * Specialties repeater field
				 */
				'specialties_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_specialties',
					'navigateToLabel' => esc_html__( 'Add specialties &rarr;', 'medzone-lite' ),
				),
				'specialties_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_specialties',
				),
			),
		);
	}

	/**
	 * Create appointment section
	 *
	 * @return array
	 */
	private function repeatable_appointment() {
		$arr = array(
			'id'          => 'appointment',
			'title'       => esc_html__( 'Appointments Section', 'medzone-lite' ),
			'description' => esc_html__( 'Contact form for your appointments, you need to have a working CF7 form created (included in the demo content).', 'medzone-lite' ),
			'fields'      => array(
				'appointment_title'      => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Make an Appointment' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'appointment_text'       => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p>You do not need your physician or health care provider to make arrangements for you. Now it is easy and fast and you can book a consult within minutes!</p>' ),
				),
				'appointment_background' => array(
					'label'   => esc_html__( 'Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'default' => '',
				),
				'appointment_form'       => array(
					'label'   => esc_html__( 'Appointment form', 'medzone-lite' ),
					'type'    => 'select',
					'choices' => array(
						'' => __( 'Select a Contact Form7 form', 'medzone-lite' ),
					),
					'default' => '',
				),
			),
		);

		if ( defined( 'WPCF7_VERSION' ) ) {
			/**
			 * Get cforms, populated appointment_form
			 */
			$args = array(
				'post_type' => 'wpcf7_contact_form',
			);

			$posts = new WP_Query( $args );
			wp_reset_postdata();
			if ( $posts->have_posts() ) {
				while ( $posts->have_posts() ) {
					$posts->the_post();

					$arr['fields']['appointment_form']['choices'][ get_the_ID() ] = get_the_title();
				}
			}
		}

		return $arr;
	}

	/**
	 * Render OpenHours section
	 *
	 * @return array
	 */
	private function repeatable_openhours() {
		return array(
			'id'          => 'openhours',
			'title'       => esc_html__( 'Open Hours Section', 'medzone-lite' ),
			'description' => esc_html__( 'Your hospital schedule.', 'medzone-lite' ),
			'fields'      => array(
				'openhours_title'          => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Top notch <br>experience' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'openhours_text'           => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p class="text-center">Our specialist make sure you get the best care there is.</p><p class="text-center"><a class="btn btn-small" href="#">Make an appointment</a></p>' ),
				),
				'openhours_background'     => array(
					'label'   => esc_html__( 'Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'default' => '',
				),
				'openhours_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_hospital_schedule_section',
					'navigateToLabel' => esc_html__( 'Add schedule &rarr;', 'medzone-lite' ),
				),
				'openhours_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_hospital_schedule',
				),
			),
		);
	}

	/**
	 * Render the repeatable hospital section
	 *
	 * @return array
	 */
	private function repeatable_hospital() {
		return array(
			'id'          => 'hospital',
			'title'       => esc_html__( 'Explore Hospital Section', 'medzone-lite' ),
			'description' => esc_html__( 'A fullwidth section containing a slider to display photos from your hospital.', 'medzone-lite' ),
			'fields'      => array(
				'hospital_title'   => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Explore our Hospital' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'hospital_info'    => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p>MedZone_Lite Hospital is dedicated to improving the quality of care for the patients who suffer a heart attack and related illnesses.</p> <a class="btn" href="#">VIew our rooms</a>' ),
				),
				'hospital_image_1' => array(
					'label'   => esc_html__( 'Accommodation Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'size'    => 'medzone-hospital-slider',
					'default' => '',
				),
				'hospital_image_2' => array(
					'label'   => esc_html__( 'Accommodation Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'size'    => 'medzone-hospital-slider',
					'default' => '',
				),
				'hospital_image_3' => array(
					'label'   => esc_html__( 'Accommodation Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'size'    => 'medzone-hospital-slider',
					'default' => '',
				),
			),
		);
	}

	/**
	 * Render involvement section
	 *
	 * @return array
	 */
	private function repeatable_involvement() {
		return array(
			'id'          => 'involvement',
			'title'       => esc_html__( 'Involvement Section', 'medzone-lite' ),
			'description' => esc_html__( 'A nicely designed information section.', 'medzone-lite' ),
			'fields'      => array(
				'involvement_title' => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'True Involvement in Patient Care' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'involvement_text'  => array(
					'label'   => esc_html__( 'Description', 'medzone-lite' ),
					'type'    => 'epsilon-text-editor',
					'default' => wp_kses_post( '<p>Regina earned the award by meeting specific criteria and standards of performance for the quick and appropriate treatment of STEMI patients by providing emergency procedures to re-establish blood flow to blocked arteries when needed.</p><p>Eligible hospitals must adhere to these measures at a set level for a designated period to receive the awards.</p>' ),
				),
				'involvement_image' => array(
					'label'   => esc_html__( 'Image', 'medzone-lite' ),
					'type'    => 'epsilon-image',
					'default' => '',
				),
			),
		);
	}

	/**
	 * Render doctors section
	 *
	 * @return array
	 */
	private function repeatable_doctors() {
		return array(
			'id'          => 'doctors',
			'title'       => esc_html__( 'Doctors Section', 'medzone-lite' ),
			'description' => esc_html__( 'Display doctors added in the Theme Content / Doctors section.', 'medzone-lite' ),
			'fields'      => array(
				'doctors_title'          => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Meet our Doctors' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'doctors_subtitle'       => array(
					'label'             => esc_html__( 'Subtitle', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'sanitize_callback' => 'wp_kses_post',
					'default'           => wp_kses_post( '<p class="text-center">Our experts are here for you every single day! We care about our patients and we<br>do our best to make them happy.</p>' ),
				),
				'doctors_group'          => array(
					'label'    => esc_html__( 'Group', 'medzone-lite' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => MedZone_Lite_Helper::get_group_values_from_meta( 'medzone_lite_doctors', 'doctor_name' ),
					'default'  => 'all',

				),
				'doctors_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_doctors_section',
					'navigateToLabel' => esc_html__( 'Add doctors &rarr;', 'medzone-lite' ),
				),
				'doctors_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_doctors',
				),
			),
		);
	}

	/**
	 * Repeatable testimonials section
	 *
	 * @return array
	 */
	private function repeatable_testimonials() {
		return array(
			'id'          => 'testimonials',
			'title'       => esc_html__( 'Testimonials Section', 'medzone-lite' ),
			'description' => esc_html__( 'A testimonial section. It retrieves content from Theme Content / Testimonials.', 'medzone-lite' ),
			'fields'      => array(
				'testimonials_title'          => array(
					'label'             => esc_html__( 'Title', 'medzone-lite' ),
					'type'              => 'epsilon-text-editor',
					'default'           => wp_kses_post( 'Why Choose us?' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'testimonials_grouping'       => array(
					'label'    => esc_html__( 'Testimonials to show', 'medzone-lite' ),
					'type'     => 'selectize',
					'multiple' => true,
					'choices'  => MedZone_Lite_Helper::get_group_values_from_meta( 'medzone_lite_testimonials', 'testimonial_title' ),
					'default'  => array( 'all' ),
				),
				'testimonials_navigation'     => array(
					'type'            => 'epsilon-customizer-navigation',
					'opensDoubled'    => true,
					'navigateToId'    => 'medzone_lite_testimonials_section',
					'navigateToLabel' => esc_html__( 'Add Testimonials &rarr;', 'medzone-lite' ),
				),
				'testimonials_repeater_field' => array(
					'type'    => 'hidden',
					'default' => 'medzone_lite_testimonials',
				),
			),
		);
	}
}
