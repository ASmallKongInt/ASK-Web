<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package skil
 */

$skil_ifSidebarClassesForContent = 'col-sm-8 col-sm-offset-2';

$skil_sidebarPosition = get_theme_mod('skil_page_sidebar_position');

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
					<?php endif;?>
					<section class="<?php echo esc_attr($skil_ifSidebarClassesForContent); ?> no-results error-404">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'skil' ); ?></h1>
						</header><!-- .page-header -->
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'skil' ); ?></p>

						<?php
							get_search_form();
						?>
					</section>
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
