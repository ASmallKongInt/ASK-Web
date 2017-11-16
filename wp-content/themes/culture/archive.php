<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Culture already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Culture
 */
get_header(); ?>

<div id="container">
	<div class="container">
		<div class="row">
			<!--#content/.archive-wrap-->
			<div id="content" class="col-md-9 col-sm-8 col-xs-12 archive-wrap">
				<!-- .inner-content -->
				
				<div class="inner-content">
					<?php
						the_archive_title( '<h2 class="entry-title">', '</h2>' );
					?>
					<div class="entry-listing">
						<?php 
							// Start the Loop.
							if(have_posts()) :						
							while(have_posts()) : the_post();
							// Include the page content template.
							get_template_part( 'template-parts/content', get_post_format() );
							endwhile; 

							// Previous/next page navigation.
							the_posts_pagination( array(
								'prev_text'          => __( '<i class="fa fa-angle-left" aria-hidden="true"></i> Previous page', 'culture' ),
								'next_text'          => __( 'Next page <i class="fa fa-angle-right" aria-hidden="true"></i>', 'culture' ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'culture' ) . ' </span>',
							));
						?> 
						<?php else :
						// Include the page content template.
						get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; ?>
					</div><!-- .entry-listing -->
				</div><!-- .inner-content-->					
			</div><!-- #content -->
			
			<?php get_sidebar( 'blog' ); ?>			
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->
<?php get_footer(); ?>