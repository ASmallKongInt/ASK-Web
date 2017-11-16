<?php
get_header(); 
global $shapeshifter_page_template_slug, $shapeshifter_theme_mods, $shapeshifter_content_inner_width;
if ( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE ) {
?>
	<main id="main-content" class="main-content">

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
} elseif ( SHAPESHIFTER_IS_FRONT_PAGE ) {
?>
	<main id="main-content" class="main-content">
		<?php if ( have_posts() ) { while( have_posts() ) { the_post(); global $post; ?>

			<article role="main" <?php if ( SHAPESHIFTER_IS_SINGLE ) post_class(); ?>>
				<!-- Content -->
					<?php $post_type = get_post_type( $post ); ?>
					<?php shapeshifter_widget_areas_beginning_of_content(); ?>
					<div class="e-content entry-content shapeshifter-content<?php echo esc_attr( 
							! empty( $post_type )
							? ' shapeshifter-content-' . $post_type 
							: '' 
						); unset( $post_type ); ?>"
					>
						<?php the_content(); ?>

						<div class="clearfix"></div>

						<?php shapeshifter_main_content_singular_page_link_pages( $post ); ?>

						<div class="clearfix"></div>

					</div>
					<?php shapeshifter_widget_areas_end_of_content(); ?>
			</article>

		<?php } } else { esc_html_e( 'No Post', 'shapeshifter' ); } ?>
	</main>
	<div class="clearfix"></div>
<?php
} elseif ( SHAPESHIFTER_IS_HOME ) { 
?>
	<main id="main-content" class="main-content">

		<h1 class="home-title">
			<?php echo get_the_title( intval( get_option( 'page_for_posts' ) ) ); ?>
		</h1>

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
}
shapeshifter_footer();
?>