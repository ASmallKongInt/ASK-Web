<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$skil_ifSidebarClassesForContent = 'col-sm-8 col-sm-offset-2';

$skil_sidebarPosition = get_theme_mod('skil_home_sidebar_position');

if ( $skil_sidebarPosition === 'left-sidebar' || $skil_sidebarPosition === 'right-sidebar' ) {
	$skil_ifSidebarClassesForContent = 'col-sm-8';
}

get_header(); ?>

	<main class="main-content" itemscope="itemscope" itemtype="http://schema.org/Blog">
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

							the_posts_navigation();

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
