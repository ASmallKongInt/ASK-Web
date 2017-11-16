<?php
/**
 * @package Theme Freesia
 * @subpackage Idyllic
 * @since Idyllic 1.0
 */
?>
<?php
/************************* IDYLLIC FOOTER DETAILS **************************************/

function idyllic_site_footer() {
if ( is_active_sidebar( 'idyllic_footer_options' ) ) :
		dynamic_sidebar( 'idyllic_footer_options' );
	else:
		echo '<div class="copyright">'; ?>
		<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
						<?php esc_html_e('Designed by:','idyllic'); ?> <a title="<?php echo esc_attr__( 'Theme Freesia', 'idyllic' ); ?>" target="_blank" href="<?php echo esc_url( 'https://themefreesia.com' ); ?>"><?php esc_html_e('Theme Freesia','idyllic');?></a> <span> 
						<?php  echo '&copy; ' . date_i18n(__('Y','idyllic')) ; ?> <a title="<?php echo esc_attr__( 'WordPress', 'idyllic' );?>" target="_blank" href="<?php echo esc_url( 'https://wordpress.org' );?>"><?php esc_html_e('WordPress','idyllic'); ?></a> </span>
					</div>
	<?php endif;
}
add_action( 'idyllic_sitegenerator_footer', 'idyllic_site_footer');