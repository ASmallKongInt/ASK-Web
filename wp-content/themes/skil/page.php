<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

$skil_authorID = get_current_user_id();

$skil_featuredImageClasses = '';

if ( has_post_thumbnail( $post->ID ) ):

	$skil_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

	$skil_featuredImageClasses = 'light-logo dark-overlay';

endif;

$skil_ifSidebarClassesForContent = 'col-sm-8 col-sm-offset-2';

$skil_sidebarPosition = get_theme_mod('skil_page_sidebar_position');

if ( $skil_sidebarPosition === 'left-sidebar' || $skil_sidebarPosition === 'right-sidebar' ) {
	$skil_ifSidebarClassesForContent = 'col-sm-8';
}

get_header();?>

	<main class="main-content" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/Blog'); ?>">
		<div class="container">
			<article class="single-article">
				<div class="row">
					<div class="col-sm-12">
						<figure class="article-featured-image <?php echo esc_attr($skil_featuredImageClasses); ?>" style="background-image: url('<?php if ( has_post_thumbnail( $post->ID ) ) echo esc_url($skil_image[0]); ?>');">
							<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
							<img src="<?php echo esc_url($skil_image[0]); ?>" alt="">
							<?php }; ?>
							<figcaption>
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
						<div class="single-article-entry-content page-content">
							<div class="single-content-text">
								<?php
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content', 'page' );

								endwhile; // End of the loop.
								?>
							</div>
						</div>
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
