<?php
/**
 * The template used for displaying page content
 *
 * @subpackage Culture
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page and title.
		the_title( '<h1 class="entry-title">', '</h1>' );
		culture_post_thumbnail();
	?>

	<div class="entry-content">
		<?php
			the_content();
		?>

		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'culture' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'culture' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'culture' ),
					get_the_title()
				),
				'<footer class="entry-footer"><span class="edit-link">',
				'</span></footer><!-- .entry-footer -->'
			);
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->