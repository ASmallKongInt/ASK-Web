<?php
get_header(); 
global $shapeshifter_page_template_slug, $shapeshifter_theme_mods, $shapeshifter_content_inner_width;
?>

<main id="main-content" class="main-content">

	<h3 class="not-found-message">
		<i class="fa fa-info"></i><?php esc_html_e( 'The Required Page doesn\'t exist.', 'shapeshifter' ); ?>
	</h3>
	<p><?php esc_html_e( 'Please try to search for the page with keywords.', 'shapeshifter' ); ?></p>
	<?php get_search_form(); ?>

</main>
<div class="clearfix"></div>

<?php
shapeshifter_footer();

