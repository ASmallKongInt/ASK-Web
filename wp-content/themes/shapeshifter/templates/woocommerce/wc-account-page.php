<?php
# Action Hook "shapeshifter_woocommerce_account_page"
# Filter Hook "shapeshifter_filters_wc_account_page"

echo '<main id="main-content" class="main-content">';
	echo '<article '; post_class( 'h-entry' ); echo '>';

		if ( have_posts() ) { while( have_posts() ) { the_post(); global $post;

			shapeshifter_breadcrumb( $post );

			shapeshifter_wc_header( $post );

			echo '<div class="e-content entry-content shapeshifter-content shapeshifter-wc-my-account">';
			
			the_content();

			echo '</div>';

		} } else { esc_html_e( 'No Posts.', 'shapeshifter' ); }

	echo '</article>';
echo '</main>';
echo '<div class="clearfix"></div>';
