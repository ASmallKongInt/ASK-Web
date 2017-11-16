<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

$skil_ifSidebarClassesForContent = 'col-sm-8 col-sm-offset-2';

$skil_sidebarPosition = get_theme_mod('skil_archive_sidebar_position');

if ( $skil_sidebarPosition === 'left-sidebar' || $skil_sidebarPosition === 'right-sidebar' ) {
	$skil_ifSidebarClassesForContent = 'col-sm-8';
}

get_header(); ?>

	<main class="main-content" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/Blog'); ?>">
		<div class="container">
			<div class="row">
				<div class="container-header-space clearfix">
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
						<div class="main-blog-listing">

							<?php
								
								if ( have_posts() ) :

									if ( is_home() && ! is_front_page() ) : ?>
										<header>
											<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
										</header>

									<?php
									endif;

									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format() );

									endwhile;

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif;

							?>

						</div>
						<?php

							if ( have_posts() ) :

								the_posts_navigation();

							endif;

						?>
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
			</div>
		</div>
	</main>

<?php
get_footer();
