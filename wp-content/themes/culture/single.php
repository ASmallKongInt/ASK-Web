<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

<div id="container">
	<div class="container">
		<div class="row">
			<!-- .single-post-content starts-->
			<div id="content" class="col-md-9 col-sm-8 col-xs-12 single-post-content">
				<!-- .inner-content-->
				<div class="inner-content">
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', get_post_format() );	
					
						endwhile; // End of the loop.
					?>
	
				</div><!-- .inner-content-->
			</div><!-- #content -->				
			<?php get_sidebar( 'blog' ); ?>				
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->

<?php get_footer(); ?>