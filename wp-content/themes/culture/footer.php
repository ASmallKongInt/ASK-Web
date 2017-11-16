<?php
/**
* The template for displaying the footer.
* Contains footer content and the closing of the
*/	
// copyright text 
$culture_copyright = get_theme_mod('culture_copyright');

// footer follow icons 
$footer_fbicon     = get_theme_mod('footer_fbicon');
$footer_twicon     = get_theme_mod('footer_twicon');
$footer_gpicon     = get_theme_mod('footer_gpicon');
$footer_linkdicon  = get_theme_mod('footer_linkdicon');
$footer_dribicon   = get_theme_mod('footer_dribicon');
$footer_piniticon  = get_theme_mod('footer_piniticon');
$footer_flickricon = get_theme_mod('footer_flickricon');
$footer_instaicon  = get_theme_mod('footer_instaicon');
$footer_yticon     = get_theme_mod('footer_yticon');
?>

<!-- #footer Section Starts -->
<footer id="footer">

	<!-- .footer-siteinfo Section Starts-->
	<div class="footer-siteinfo">
		<div class="container">
		
			<div class="row">
				<!-- copyright content -->
				<div class="col-md-12 col-sm-12 col-xs-12 copyright_txt">
					<?php if(!empty($culture_copyright)){ echo wp_kses_post( $culture_copyright ); }?>
					<a href="<?php echo esc_url( __( 'https://desirepress.com', 'culture' ) ); ?>"><?php printf( __( 'Culture by %s', 'culture' ), 'DesirePress' ); ?></a>
				</div>
			</div><!-- .row -->
			
			<div class="row">
				<!-- .footer-social-icons Starts -->
				<div class="col-md-12 col-sm-12 col-xs-12 footer-social-icons">
					<ul>
					<?php if(!empty($footer_fbicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_fbicon); ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
					<?php if(!empty($footer_twicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_twicon); ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
					<?php if(!empty($footer_gpicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_gpicon); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
					<?php if(!empty($footer_dribicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_dribicon); ?>"><i class="fa fa-dribbble"></i></a></li><?php } ?>
					<?php if(!empty($footer_linkdicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_linkdicon); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
					<?php if(!empty($footer_piniticon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_piniticon); ?>"><i class="fa fa-pinterest"></i></a></li><?php } ?>
					<?php if(!empty($footer_flickricon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_flickricon); ?>"><i class="fa fa-flickr"></i></a></li><?php } ?>
					<?php if(!empty($footer_instaicon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_instaicon); ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
					<?php if(!empty($footer_yticon)){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($footer_yticon); ?>"><i class="fa fa-youtube"></i></a></li><?php } ?>			
					</ul>
				</div><!-- .footer-social-icons Ends -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .footer-siteinfo Ends -->
</footer>
<!-- #Footer Section Ends -->
<?php wp_footer(); ?>
</body>
</html>