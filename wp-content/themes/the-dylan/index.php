<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Dylan
 * @since The Dylan 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php 
				$count = 1;
			?>
            
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="<?php if ($count % 2 == 0) { echo 'even'; }else{ echo 'odd'; } ?>">
					<?php
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                        $count++;
                    ?>
				</div>
                
			<?php endwhile; ?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		<?php 
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => __( '<span class="fa fa-chevron-left"></span>', 'the-dylan' ),
				'next_text' => __( '<span class="fa fa-chevron-right"></span>', 'the-dylan' ),
			) ); 	
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

