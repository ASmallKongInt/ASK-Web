<?php 
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage Culture
 */
get_header();
?>	
<div id="container">
	<div class="container">
		<div class="row">
			<!-- .error-page-->
			<div id="content" class="col-md-9 col-sm-9 col-xs-12 error-page">
				<!-- .blog-content-box-->
				<div class="blog-content-box">
					<!-- .main-head-wrap-->
					<div class="main-head-wrap clearfix">
						<!-- .inner-content-->
						<div class="inner-content">
							<h1 class="ttl-cat-wrap entry-title"><?php _e('Oops! That page can&rsquo;t be found.', 'culture'); ?></h1>
							<p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'culture'); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .inner-content ends-->
					</div><!-- .main-head-wrap ends-->
				</div><!-- .blog-content-box ends-->
			</div><!-- #content -->
			<?php get_sidebar( 'blog' ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->
<?php get_footer(); ?>