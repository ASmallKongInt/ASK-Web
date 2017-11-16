<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Idyllic
 * @since Idyllic 1.0
 */
?>
</div><!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer">
<?php
$idyllic_settings = idyllic_get_theme_options(); 
$footer_column = $idyllic_settings['idyllic_footer_column_section'];
	if( is_active_sidebar( 'idyllic_footer_1' ) || is_active_sidebar( 'idyllic_footer_2' ) || is_active_sidebar( 'idyllic_footer_3' ) || is_active_sidebar( 'idyllic_footer_4' )) { ?>
	<div class="widget-wrap">
		<div class="wrap">
			<div class="widget-area">
			<?php
				if($footer_column == '1' || $footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'idyllic_footer_1' ) ) :
						dynamic_sidebar( 'idyllic_footer_1' );
					endif;
				echo '</div><!-- end .column'.$footer_column. '  -->';
				}
				if($footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'idyllic_footer_2' ) ) :
						dynamic_sidebar( 'idyllic_footer_2' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'idyllic_footer_3' ) ) :
						dynamic_sidebar( 'idyllic_footer_3' );
					endif;
				echo '</div><!--end .column'.$footer_column.'  -->';
				}
				if($footer_column == '4'){
				echo '<div class="column-'.$footer_column.'">';
					if ( is_active_sidebar( 'idyllic_footer_4' ) ) :
						dynamic_sidebar( 'idyllic_footer_4' );
					endif;
				echo '</div><!--end .column'.$footer_column.  '-->';
				}
				?>
			</div> <!-- end .widget-area -->
		</div><!-- end .wrap -->
	</div> <!-- end .widget-wrap -->
	<?php } ?>
	<div class="site-info" <?php if($idyllic_settings['idyllic-img-upload-footer-image'] !=''){?>style="background-image:url('<?php echo esc_url($idyllic_settings['idyllic-img-upload-footer-image']); ?>');" <?php } ?>>
	<div class="wrap">
	<?php do_action('idyllic_footer_menu');
	if($idyllic_settings['idyllic_buttom_social_icons'] == 0):
		do_action('idyllic_social_links');
	endif;

	do_action('idyllic_sitegenerator_footer'); ?>
			<div style="clear:both;"></div>
		</div> <!-- end .wrap -->
	</div> <!-- end .site-info -->
	<?php
		$disable_scroll = $idyllic_settings['idyllic_scroll'];
		if($disable_scroll == 0):?>
			<a class="go-to-top">
				<span class="icon-bg"></span>
				<span class="back-to-top-text"><?php esc_html_e('Top','idyllic');?></span>
				<i class="fa fa-angle-up back-to-top-icon"></i>
			</a>
	<?php endif; ?>
	<div class="page-overlay"></div>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>