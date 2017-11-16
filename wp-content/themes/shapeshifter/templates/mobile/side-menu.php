<?php
# Action Hook "shapeshifter_mobile_side_menu"
# Filter Hook "shapeshifter_filters_mobile_side_menu"

echo '<aside id="shapeshifter-mobile-side-menu-aside" class="shapeshifter-mobile-side-menu-aside">' . PHP_EOL;

	shapeshifter_widget_areas_mobile_menu();

	echo '<div class="clearfix"></div>' . PHP_EOL;

echo '</aside>';
