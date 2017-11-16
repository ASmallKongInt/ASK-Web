<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Floral
 */

?>

<article id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php floral_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'floral-lite' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author">
			<div class="author__content">
				<div class="avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
				</div>
				<div class="info">
					<h3><span><?php esc_html_e( 'Posted by ','floral-lite' ) ?></span><?php the_author(); ?></h3>
					<p><?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<footer class="entry-footer">
		<?php floral_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
