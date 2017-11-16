<?php
# Action Hook "shapeshifter_main_content_singular_page_footer"
# Filter Hook "shapeshifter_filters_singular_footer"

# Prev Next
	if ( SHAPESHIFTER_IS_SINGLE ) {
		global $post;
		shapeshifter_main_content_singular_page_prev_next( $post );
	}
