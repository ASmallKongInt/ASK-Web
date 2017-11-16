<?php
get_header(); 
global $shapeshifter_page_template_slug, $shapeshifter_theme_mods, $shapeshifter_content_inner_width;

$post_type = get_post_type( $post );
?>

<main id="main-content" class="main-content">
	<?php if ( have_posts() ) { while( have_posts() ) { the_post(); global $post; ?>

		<!-- Breadcrumb -->
		<?php shapeshifter_breadcrumb( $post ); ?>

		<article role="main" <?php if ( SHAPESHIFTER_IS_SINGLE ) post_class(); ?>>

			<!-- Header -->
			<?php shapeshifter_main_content_singular_page_header( $post ); ?>

			<!-- Content -->
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

		<!-- Comments Pings -->
		<?php
			if ( comments_open( $post ) || get_comments_number() ) { 
				comments_template(); 
			} 
		?>

	<?php } } else { esc_html_e( 'No Post', 'shapeshifter' ); } ?>
</main>
<div class="clearfix"></div>

<?php
shapeshifter_footer();
?>