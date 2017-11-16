<?php
$suparnova_lite_categories = wp_get_post_categories( get_the_ID(), 'fields=all' );
?>
<div class="entry-category">
	<?php
	foreach( $suparnova_lite_categories as $category ) {
		echo sprintf( '<a href="%s" class="suparnova-lite-category-%s">%s</a>', esc_url( get_term_link( $category ) ), esc_attr( $category->slug ), esc_html( $category->name ) );
	}
	?>
	
</div>