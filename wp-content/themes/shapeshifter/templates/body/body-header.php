<?php
# Action Hook "shapeshifter_body_header"
# Filter Hook "shapeshifter_filters_body_header"

# Header Top
	shapeshifter_header_top();

# Logo
	if ( SHAPESHIFTER_IS_HOME || SHAPESHIFTER_IS_FRONT_PAGE )
		shapeshifter_header_logo();

# After Header
	ob_start();
		shapeshifter_after_header();
	$after_header = ob_get_clean();
	if( ! empty( $after_header ) ) {
		echo '<div class="after-header-div">';
			echo $after_header;
		echo '</div>';
	} unset( $after_header );

# Nav Menu
	shapeshifter_nav_menu();

# Before Content Area
	ob_start();
		shapeshifter_before_content_area();
	$before_content_area = ob_get_clean();
	if( ! empty( $before_content_area ) ) {
		echo '<div class="shapeshifter-before-content-area-wrapper">';
			echo $before_content_area;
		echo '</div>';		
	} unset( $before_content_area );

