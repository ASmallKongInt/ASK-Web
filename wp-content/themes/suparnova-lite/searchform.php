<?php
$suparnova_lite_total_forms = suparnova_lite_global_get( 'suparnova_lite_search_forms' );
if( $suparnova_lite_total_forms === false ) {
	$suparnova_lite_total_forms = 0;
}
$suparnova_lite_total_forms++;
suparnova_lite_global_set( 'suparnova_lite_search_forms', $suparnova_lite_total_forms );
?><form action="<?php echo esc_url( home_url('/') ); ?>" class="search-form suparnova-lite-search-form" autocomplete="off">
	<label for="search-field-<?php echo esc_attr( $total_forms ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'suparnova-lite' ); ?></label>
	<input id="search-field-<?php echo esc_attr( $total_forms ); ?>" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" class="search-field" placeholder="<?php esc_attr_e( 'Search for something...', 'suparnova-lite' ); ?>">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>