<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suparnova
 */

do_action('suparnova_lite_container_end');
?>

	</div>
	<?php
	suparnova_lite_footer_banner();
	suparnova_lite_footer_widgets();
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php get_template_part( 'components/footer/site', 'info' ); ?>
				</div>
				<div class="col-md-4">
					<?php get_template_part( 'components/footer/site', 'socials' ); ?>
				</div>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
