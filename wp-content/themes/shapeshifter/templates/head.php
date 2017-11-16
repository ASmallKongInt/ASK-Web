<?php
# Action Hook "shapeshifter_head"
# Filter Hook "shapeshifter_filters_header"
echo '<!DOCTYPE html>' . PHP_EOL;
echo '<html ';
	language_attributes();
echo '>' . PHP_EOL;
echo '<head>' . PHP_EOL;
	echo '<meta charset="';
	bloginfo( 'charset' );
	echo '" />' . PHP_EOL;
	echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">' . PHP_EOL;
	echo '<meta name="format-detection" content="telephone=no" />' . PHP_EOL;
	wp_head();
echo '</head>' . PHP_EOL;
