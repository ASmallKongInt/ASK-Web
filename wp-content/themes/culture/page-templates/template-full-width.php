<?php 
/**
 * Template Name: Full Width Page
 *
 * @subpackage Culture
 * @since Culture 1.0
 */
get_header(); 
?>
<div id="container" class="fullwidth-temp">
	<div class="container">
		<div class="row">
			<!-- #content -->
			<div id="content" class="col-md-12">
				<!-- .page-content -->
				<div class="page-content blog-content-box">
					<!-- .main-head-wrap -->
					<div class="main-head-wrap clearfix">
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
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->
<?php get_footer(); ?>