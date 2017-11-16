<?php
# Action Hook "shapeshifter_starting_body"
# Filter Hook "shapeshifter_filters_starting_body"

global $shapeshifter_frontend_classes, $shapeshifter_content_width;
$shapeshifter_wrapper_class = $GLOBALS['shapeshifter_frontend_classes']['shapeshifter_wrapper_class'];

echo '<body ';
	//echo 'id="shapeshifter-body-' . esc_attr( SHAPESHIFTER_IS_MOBILE ? 'mobile' : 'pc' ) . '" ';
	body_class( $shapeshifter_wrapper_class );
echo '>';

	shapeshifter_body_wrapper_start();

	echo '<div ';
		echo 'class="shapeshifter-outer-wrapper shapeshifter-outer-wrapper-' . absint( $shapeshifter_content_width ) . esc_attr( 
			SHAPESHIFTER_IS_MOBILE 
			? '-for-mobile' 
			: '' 
		) . ' ' . esc_attr( $shapeshifter_wrapper_class[ 0 ] ) . '" ';
		unset( $shapeshifter_wrapper_class );
	echo '>';
		echo '<div class="shapeshifter-inner-wrapper">';

			shapeshifter_body_header();

