<?php
# Action Hook "shapeshifter_footer"
# Filter Hook "shapeshifter_filters_footer"

			shapeshifter_content_area_end();

		echo '</div>' . PHP_EOL;

		shapeshifter_footer_section();

	echo '</div>' . PHP_EOL;

	shapeshifter_body_wrapper_end();

	wp_footer();

echo '</body>
</html>';

