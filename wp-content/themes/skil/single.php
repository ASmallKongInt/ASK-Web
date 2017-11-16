<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package skil
 */

$skil_format = get_post_format() ? : 'standard';

$skil_ifSidebarClassesForContent = 'col-sm-8 col-sm-offset-2';
$skil_ifSidebarClassesForContentSingle = 'single-article-entry-content';

$skil_sidebarPosition = get_theme_mod('skil_article_sidebar_position');

if ( $skil_sidebarPosition === 'right-sidebar' ) {
	$skil_ifSidebarClassesForContent = 'col-sm-8';
}

if ( $skil_sidebarPosition === 'left-sidebar' || $skil_sidebarPosition === 'right-sidebar' ) {
	$skil_ifSidebarClassesForContent = 'col-sm-8';
	$skil_ifSidebarClassesForContentSingle = 'single-article-entry-content single-article-with-sidebar';
}

$skil_authorID = get_current_user_id();

$skil_featuredImageClasses = '';

if ( has_post_thumbnail( $post->ID ) ):

	$skil_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

	$skil_featuredImageClasses = 'light-logo dark-overlay';

endif;

get_header();?>
	
	<div class="hide">
		<?php the_post_thumbnail(); ?>
	</div>

	<main class="main-content" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/Blog'); ?>">
		<div class="container">
			<article <?php post_class('single-article'); ?>>
				<div class="row">
					<div class="col-sm-12">
						<figure class="article-featured-image <?php echo esc_attr($skil_featuredImageClasses); ?>" style="background-image: url('<?php if ( has_post_thumbnail( $post->ID ) ) echo esc_url($skil_image[0]); ?>');">
							<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
							<img src="<?php echo esc_url($skil_image[0]); ?>" alt="">
							<?php }; ?>
							<figcaption>
								<ul class="article-info" itemscope itemtype="<?php echo esc_url('http://schema.org/PublicationVolume'); ?>">
									<li itemscope itemtype="<?php echo esc_url('http://schema.org/PublicationIssue'); ?>">
										<?php esc_html_e( 'posted by', 'skil' ); ?>
										<a href="#" class="author">
											<span>
												<?php the_author_meta( 'display_name' , $skil_authorID ); ?>
											</span>
										</a>
									</li>
									<li itemscope itemtype="<?php echo esc_url('http://schema.org/PublicationIssue'); ?>">
										<a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
											<time datetime="<?php echo the_date( 'c' ); ?>">
												<?php echo the_time( get_option( 'date_format' ) ); ?>
											</time>
										</a>
									</li>
									<li itemscope itemtype="<?php echo esc_url('http://schema.org/PublicationIssue'); ?>">
										<?php

											$skil_categories = get_the_category();
											$skil_separator = ' ';
											$skil_output = '';

											if ( ! empty( $skil_categories ) ) :
												foreach( $skil_categories as $category ) {
													$skil_category_id = get_cat_ID( $category->name );
													$skil_output .= '<a href="' . get_category_link( $skil_category_id ) . '">';
														$skil_output .= esc_html( $category->name ) . $skil_separator;
													$skil_output .= '</a>';
												}
												echo trim( $skil_output, $skil_separator );
											endif;

										?>
									</li>
								</ul>
								<h1>
									<?php the_title(); ?>
								</h1>
							</figcaption>
						</figure>
					</div>
					<?php if ( $skil_sidebarPosition === 'left-sidebar' ): ?>
						<?php if ( is_active_sidebar('sidebar-1') ): ?>
						<div class="col-sm-4">
							<div class="main-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					<div class="<?php echo esc_attr($skil_ifSidebarClassesForContent); ?>">
						<div class="<?php echo esc_attr($skil_ifSidebarClassesForContentSingle); ?>">
							<div class="single-content-text clearfix">
							<?php

								while ( have_posts() ) : the_post();
								
									get_template_part( 'template-parts/content', 'article' );
								
									// If comments are open or we have at least one comment, load up the comment template.
									// if ( comments_open() || get_comments_number() ) :
									// 	comments_template();
									// endif;
								
								endwhile; // End of the loop.
								?>
							</div>
							<?php if ( get_the_author_meta('description') != '' ): ?>
							<div class="single-author-info">
								<div class="row">
									<div class="col-sm-8 col-sm-offset-2">
										<div class="top-author">
											<span>
												<?php esc_html_e( 'about', 'skil' ); ?>
											</span>
											<img src="<?php echo esc_url(get_avatar_url( $skil_authorID )); ?>" alt="author-img">
											<span>
												<?php esc_html_e( 'author', 'skil' ); ?>
											</span>
										</div>
										<div class="author-description">
											<p>
												<?php echo get_the_author_meta('description'); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<?php endif ?>
							<?php if (comments_open()): ?>
							<div class="single-comments-area">
								<h3>
									<?php comments_number(esc_html__('no comments', 'skil'), esc_html__(' comment ', 'skil') . '(1)', esc_html__('comments ', 'skil') . '(%)'); ?>
								</h3>
								<?php

									// If comments are open or we have at least one comment, load up the comment template.
									if ( get_comments_number() ) :
										comments_template();
									endif;

								?>
							</div>
							<?php endif ?>
							<div class="single-comment-form-bg clearfix">
								<div class="col-sm-10 col-sm-offset-1">
									<?php skil_custom_comment__form(wp_get_current_commenter(),get_option( 'require_name_email' )); ?>
								</div>
							</div>
						</div>
					</div>
					<?php if ( $skil_sidebarPosition === 'right-sidebar' ): ?>
						<?php if ( is_active_sidebar('sidebar-1') ): ?>
						<div class="col-sm-4">
							<div class="main-sidebar left-p">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</article>
		</div>
	</main>

<?php
get_footer();
