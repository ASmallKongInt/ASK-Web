<?php
# Action Hook "shapeshifter_content_area"
# Filter Hook "shapeshifter_filters_content_area"

global $shapeshifter_content_width, $shapeshifter_content_inner_width, $shapeshifter_is_one_column_page_width_size_max;

if ( ! isset( $shapeshifter_is_one_column_page_width_size_max ) ) $shapeshifter_is_one_column_page_width_size_max = get_theme_mod( 'is_one_column_main_content_max_width_on', false );

		// Main Content End
			shapeshifter_after_content(); 

			echo '</div>';

		// 標準右サイドバーコンテナー
			if ( ! SHAPESHIFTER_IS_MOBILE ) {
				echo $GLOBALS[ 'shapeshifter_get_standard_sidebar_right_container' ];
				$GLOBALS[ 'get_standard_sidebar_right_container' ] = null;
			}

	echo '</div>';
echo '</div>';
echo '<div class="clearfix"></div>';

