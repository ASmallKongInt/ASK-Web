<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skil
 */

$skil_get_widebars 						= wp_get_sidebars_widgets();
$skil_get_footer_sidebar 				= $skil_get_widebars['sidebar-2'];
$skil_get_footer_sidebar_widgets_number	= count($skil_get_footer_sidebar);
$skil_footer_sidebar_columns_class		= 'cols-1';

if ( $skil_get_footer_sidebar_widgets_number == 2 ) {
	$skil_footer_sidebar_columns_class		= 'cols-2';
} else if ( $skil_get_footer_sidebar_widgets_number == 3 ) {
	$skil_footer_sidebar_columns_class		= 'cols-3';
} else if ( $skil_get_footer_sidebar_widgets_number > 3 ) {
	$skil_footer_sidebar_columns_class		= 'cols-4';
}

?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ): ?>

	<footer class="main-footer" itemscope="itemscope" itemtype="<?php echo esc_url('http://schema.org/WPFooter'); ?>">
		<div class="container">
			<div class="row">
				<div class="top-footer clearfix <?php echo esc_attr($skil_footer_sidebar_columns_class); ?>">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</div>
		</div>
	</footer>

	<?php else: ?>

	<div class="footer-empty-gap"></div>

	<?php endif ?>

	<div class="copyrights-section">
		<div class="container">
			<p>
				<?php
					echo '&copy; ' . esc_html__('Copyright','skil') . '<a href="' . esc_url(home_url()) . '"> ' . get_bloginfo( 'name' ) . '</a> ' . date_i18n( __( 'Y' , 'skil' ) );
				?>
			</p>
		</div>
	</div>

<?php wp_footer(); ?>

</body>
</html>
