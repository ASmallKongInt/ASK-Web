<?php
/**
 * The template for displaying custom search form
 *
 * @package Floral
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'floral-lite' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Enter your Keyword', 'floral-lite' ); ?>" value="<?php the_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">
		<i class="fa fa-search"></i>
		<span class="screen-reader-text"><?php esc_attr_e( 'Search', 'floral-lite' ); ?></span>
	</button>
</form>
