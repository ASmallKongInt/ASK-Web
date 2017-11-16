<?php
/* 
Template Name: Blog Template
*/ 
get_header(); 
?>
<div id="container">
	<div class="container">
		<div class="row">
			<div id="content" class="col-md-9 col-sm-8 col-xs-12 archive-wrap">
				<div class="inner-content">
					<div class="entry-listing">
						<?php
							// Fetch blog posts
							if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;
							}
							
							$posts_args = array('post_type' => 'post','paged' => $paged );
							$wp_query   = new WP_Query($posts_args); 
			
							// Start the Loop.
							if($wp_query->have_posts()) : 
							while ( $wp_query->have_posts() ) : $wp_query->the_post();
							get_template_part( 'template-parts/content', get_post_format() );
							endwhile; 

							// Previous/next page navigation.
							the_posts_pagination( array(
								'prev_text'          => __( '<i class="fa fa-angle-left" aria-hidden="true"></i> Previous page', 'culture' ),
								'next_text'          => __( 'Next page <i class="fa fa-angle-right" aria-hidden="true"></i>', 'culture' ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'culture' ) . ' </span>',
							));
								
							wp_reset_postdata();
						?> 
						<?php else : 
						// Include the page content template.
						get_template_part( 'template-parts/content', 'none' ); 
						?>
						<?php endif; ?>	
					</div><!-- .entry-listing-->
				</div><!-- .inner-content-->
			</div><!-- #content -->
			
			<?php get_sidebar( 'blog' ); ?>
			
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #container -->
<?php get_footer();?>	