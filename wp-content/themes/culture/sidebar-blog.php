<?php
/**
 * The Blog Sidebar
 *
 * @subpackage Sample
 */
 
if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
	<div id="sidebar" class="col-md-3 col-sm-4 col-xs-12 widget-area" role="complementary">
		<div class="inner-sidebar">
			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
		</div><!-- .inner-sidebar -->
	</div><!-- #sidebar -->
<?php endif; ?>