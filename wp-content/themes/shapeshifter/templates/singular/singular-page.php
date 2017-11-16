<?php
# Action Hook "shapeshifter_main_content_singular_page"
# Filter Hook "shapeshifter_filters_singular_page"

echo '<main id="main-content" class="main-content">';
	if ( have_posts() ) { while( have_posts() ) { the_post(); global $post;

		# Breadcrumb
			shapeshifter_breadcrumb( $post );

		echo '<article role="main" ';
			if ( SHAPESHIFTER_IS_SINGLE ) post_class();
		echo '>';

			# Header
				shapeshifter_main_content_singular_page_header( $post );

			# Content
				shapeshifter_main_content_singular_page_content( $post );

		echo '</article>';

		# Comments Pings
			if ( SHAPESHIFTER_IS_SINGLE 
				|| SHAPESHIFTER_IS_PAGE 
			) { 
				if ( comments_open( $post ) || get_comments_number() ) { 
					comments_template(); 
				} 
			}

		# Footer
			shapeshifter_main_content_singular_page_footer( $post );


	} } else { esc_html_e( 'No Post', 'shapeshifter' ); }
	
echo '</main>';
echo '<div class="clearfix"></div>';

