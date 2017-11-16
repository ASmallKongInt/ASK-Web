<?php
get_header(); 
global $shapeshifter_page_template_slug, $shapeshifter_theme_mods, $shapeshifter_content_inner_width;
?>

<main id="main-content" class="main-content">
	<?php if ( have_posts() ) { while( have_posts() ) { the_post(); global $post; ?>

		<article role="main" <?php post_class(); ?>>

			<!-- Header -->
			<?php shapeshifter_main_content_singular_page_header( $post ); ?>

			<!-- Content -->
			<div class="e-content entry-content shapeshifter-content entry-attachment">

				<?php
					$image_size = apply_filters( 'shapeshifter_attachment_page_size', 'large' ); 
					echo wp_get_attachment_image( get_the_ID(), $image_size );
				?>

				<?php if ( has_excerpt() ) { ?>

					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->

				<?php } ?>

				<div class="clearfix"></div>

			</div>

		</article>

	<?php } } else { esc_html_e( 'No Post', 'shapeshifter' ); } ?>
</main>
<div class="clearfix"></div>

<?php
shapeshifter_footer();
?>