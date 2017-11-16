<?php
# Action Hook "shapeshifter_footer_section"
# Filter Hook "shapeshifter_filters_footer_section"

echo '<div class="clearfix"></div>' . PHP_EOL;
ob_start();
	shapeshifter_before_footer();
$before_footer = ob_get_clean();
if( ! empty( $before_footer ) ) {
	echo '<div class="before-footer-div">' . PHP_EOL;
		echo $before_footer;
	echo '</div><div class="clearfix"></div>' . PHP_EOL;
}
unset( $before_footer );

shapeshifter_footer_last();

