<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Culture
 */
get_header();
?>
<div id="container">
	<div class="container">
		<div class="row">
			<!-- #content -->
			<div id="content" class="col-md-9 col-sm-8 col-xs-12">
				<!-- .page-content -->
				<div class="page-content blog-content-box">
					<!-- .main-head-wrap -->
					<div class="entry-header clearfix">
						<div class="inner-content">
							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();

								// Include the page content template.
								get_template_part( 'template-parts/content', 'page' );

							endwhile;
							?>
						</div><!-- .inner-content -->
					</div><!-- .main-head-wrap-->
				</div><!-- .page-content ends-->
			</div><!-- #content -->
		
			<?php get_sidebar( 'content' ); ?>
				
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->
<?php get_footer(); ?>