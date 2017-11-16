<?php
get_header(); 
global $shapeshifter_page_template_slug, $shapeshifter_theme_mods, $shapeshifter_content_inner_width;
?>
<main id="main-content" class="main-content">

	<!-- Title -->
	<?php shapeshifter_archive_page_title(); ?>

	<?php if ( have_posts() ) { ?>
		<div role="main" id="post-list" class="<?php echo esc_attr( apply_filters( 'shapeshifter_filters_class_post_list_maybe_ajax', 'post-list' ) ); ?>">
			<!-- Loop -->
			<?php while( have_posts() ) { the_post(); global $post; ?>
				<?php shapeshifter_post_list_item( $post ); ?>
			<?php } ?>

		</div>
		<?php shapeshifter_pagination(); ?>
	<?php } else { ?>
		<h3 class="not-found-message"><i class="fa fa-info"></i><?php esc_html_e( 'No Articles.', 'shapeshifter' ); ?></h3>
		<p><?php esc_html_e( 'Please try to search for the page with keywords.', 'shapeshifter' ); ?></p>
		<?php get_search_form(); ?>
	<?php } ?>
</main>

<?php
shapeshifter_footer();
?>