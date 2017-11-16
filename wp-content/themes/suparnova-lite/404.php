<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Suparnova
 */

get_header(); ?>
	<div class="row">
		<div id="primary" class="<?php suparnova_lite_content_area_class(); ?>">
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'suparnova-lite' ); ?></h1>
					</header>
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'suparnova-lite' ); ?></p>

						<?php
							get_search_form();

							the_widget( 'WP_Widget_Recent_Posts' );

							// Only show the widget if site has multiple categories.
							if ( suparnova_lite_categorized_blog() ) :
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'suparnova-lite' ); ?></h2>
							<ul>
							<?php
								wp_list_categories( array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								) );
							?>
							</ul>
						</div>
						<?php
							endif;

							/* translators: %1$s: smiley */
							$suparnova_lite_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'suparnova-lite' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$suparnova_lite_archive_content" );

							the_widget( 'WP_Widget_Tag_Cloud' );
						?>

					</div>
				</section>
			</main>
		</div>
		<?php
		get_sidebar();
		get_sidebar( '2' ); ?>
	</div><!-- .row -->
<?php get_footer();
