<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Floral
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/content', 'media' ); ?>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta">
				<?php
				if ( 'page' !== get_post_type() ) {
					floral_posted_on();
				}
				?>
			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$main_content = apply_filters( 'the_content', get_the_content() );
		if ( in_array( get_post_format(), array( 'audio', 'video' ), true ) ) {
			$media = get_media_embedded_in_content( $main_content, array(
				'audio',
				'video',
				'object',
				'embed',
				'iframe',
			) );
			$main_content = str_replace( $media, '', $main_content );
		}

		echo $main_content; /* WPCS: xss ok. */

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'floral-lite' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php floral_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
