<?php
# Action Hook "shapeshifter_content_area"
# Filter Hook "shapeshifter_filters_content_area"

global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max;

if ( ! isset( $shapeshifter_is_one_column_page_width_size_max ) )
	$shapeshifter_is_one_column_page_width_size_max = get_theme_mod( 'is_one_column_main_content_max_width_on', false );


if ( ! SHAPESHIFTER_IS_MOBILE ) {
	//global $shapeshifter_get_standard_sidebar_left_container, $shapeshifter_get_standard_sidebar_right_container;
}
echo '<div class="content-area">';
	echo '<div class="content-outer content-outer-' . absint( $shapeshifter_content_width ) . esc_attr( 
		SHAPESHIFTER_IS_MOBILE 
		? '-for-mobile' 
		: '' 
	) . '"';

		// Sidebar Left Container
		if ( ! SHAPESHIFTER_IS_MOBILE ) {
			echo $GLOBALS[ 'shapeshifter_get_standard_sidebar_left_container' ]; 
			$GLOBALS[ 'get_standard_sidebar_left_container' ] = null;
		}

		// Main Content Part
		echo '<div class="content-inner content-inner-' . absint( $shapeshifter_content_inner_width ) . esc_attr( 
			SHAPESHIFTER_IS_MOBILE 
			? '-for-mobile' 
			: '' 
		) . '">';

			// Before Content Hook
			shapeshifter_before_content();

			// Main Content
			shapeshifter_main_content();

			// After Content Hook
			shapeshifter_after_content(); 

		echo '</div>';

		// Sidebar Right Container
		if ( ! SHAPESHIFTER_IS_MOBILE ) {
			echo $GLOBALS[ 'shapeshifter_get_standard_sidebar_right_container' ];
			$GLOBALS[ 'get_standard_sidebar_right_container' ] = null;
		}

	echo '</div>';
echo '</div>';
echo '<div class="clearfix"></div>';

