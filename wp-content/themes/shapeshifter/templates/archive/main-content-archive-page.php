<?php
# Action Hook "shapeshifter_main_content_archive_page"
# Filter Hook "shapeshifter_filters_archive_page"

echo '<main id="main-content" class="main-content">';

	// Title
	shapeshifter_archive_page_title();

	if ( have_posts() ) { 

		echo '<div role="main" id="post-list" class="' . esc_attr( apply_filters( 'shapeshifter_filters_class_post_list_maybe_ajax', 'post-list' ) ) . '">';

			// Loop 
			while( have_posts() ) { the_post(); global $post; 

				// Print Each Item in DL Tag
				shapeshifter_post_list_item( $post );

			} 

		echo '</div>';

		shapeshifter_pagination();

	} else { 

		echo '<h3><i class="fa fa-info"></i>' . esc_html__( 'No Articles.', 'shapeshifter' ) . '</h3><p>' . esc_html__( 'Please try to search for the page with keywords.', 'shapeshifter' ) . '</p>';

		get_search_form();

	}

echo '</main>';
