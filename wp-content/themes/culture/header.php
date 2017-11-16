<?php
/**
 * The Header for our theme
 *
 * @subpackage Culture
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<?php
// header follow icons 
$fbicon     = get_theme_mod('fbicon');
$twicon     = get_theme_mod('twicon');
$gpicon     = get_theme_mod('gpicon');
$linkdicon  = get_theme_mod('linkdicon');
$dribicon   = get_theme_mod('dribicon');
$piniticon  = get_theme_mod('piniticon');
$flickricon = get_theme_mod('flickricon');
$instaicon  = get_theme_mod('instaicon');
$yticon     = get_theme_mod('yticon');
?>
	
<!-- #header Section Starts -->
<header id="header">	
	<!-- .header-wrapper -->
	<div class="header-wrapper">		
		<!-- .header-nav -->
		<div class="header-nav">
			<div class="container">
				<div class="row">
					<!-- #logo section-->
					<div id="logo" class="col-md-4 col-sm-4 col-xs-9">
						<div id="site-title">
							<?php 
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							} 
							?>
							<?php 
							if(!has_custom_logo()){
							?>
							<!-- #site-description -->
							<div class="site-title">
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name') ?>" ><?php bloginfo('name'); ?></a> 
								<?php 
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<div id="site-description" class="site-description"><?php echo $description; ?></div>
								<?php endif; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- #logo -->
					
					<!-- #main-navigation-->
					<?php 
					if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'Header' ) ){
						wp_nav_menu(array( 'container_class' => 'main-navigation col-md-8 col-sm-8 col-xs-3', 'container_id' => 'main-navigation', 'menu_id' => 'main-nav','menu_class' => 'menu clearfix','theme_location' => 'Header' )); 
					}
					else{
					?>
					<nav id="main-navigation" class="main-navigation col-md-8 col-sm-8 col-xs-3">
						<ul id="main-nav" class="menu clearfix">
							<?php wp_list_pages('title_li=&depth=0'); ?>
						</ul>
					</nav>
					<?php 
					}
					?>
					<!-- #main-navigation -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .header-nav -->		
	</div><!-- .header-wrapper -->
	
	<!-- display .header-banner for "Blog page template" -->
	<?php if ( is_page_template( 'page-templates/template-blog.php' ) ) { ?>
		<!-- .header-banner -->
		<div class="header-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php 
						$authorid = get_theme_mod( 'user_id');
						$username = get_the_author_meta('display_name',$authorid);
						$userbio  = get_the_author_meta('description',$authorid);		
						?>
						<!-- .author description starts -->
						<?php if (!empty($authorid)){ ?>
							<div class="author-desc-box">																	
								<div class="author-image"><?php culture_get_author_avatar($authorid); ?></div>
								<div class="author-detail">
									<?php if(!empty($username)){ ?>
										<div class="author-name">
											<h3><?php echo esc_attr( $username ); ?></h3>								
										</div>
									<?php } ?>
									
									<?php if(!empty($userbio)){ ?>
										<div class="author-desc">
											<h5><?php echo esc_attr( $userbio ); ?></h5>								
										</div>
									<?php } ?>
									
									<!--Social Icons-->
									<div class="social-icons">
										<ul>
											<?php if(isset($fbicon) && $fbicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($fbicon); ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
											<?php if(isset($twicon) && $twicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($twicon); ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
											<?php if(isset($gpicon) && $gpicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($gpicon); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
											<?php if(isset($dribicon) && $dribicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($dribicon); ?>"><i class="fa fa-dribbble"></i></a></li><?php } ?>
											<?php if(isset($linkdicon) && $linkdicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($linkdicon); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
											<?php if(isset($piniticon) && $piniticon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($piniticon); ?>"><i class="fa fa-pinterest"></i></a></li><?php } ?>
											<?php if(isset($flickricon) && $flickricon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($flickricon); ?>"><i class="fa fa-flickr"></i></a></li><?php } ?>
											<?php if(isset($instaicon) && $instaicon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($instaicon); ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
											<?php if(isset($yticon) && $yticon !=""){ ?><li><a class="icon-item" target="_blank" href="<?php echo esc_url($yticon); ?>"><i class="fa fa-youtube"></i></a></li><?php } ?>										
										</ul>
									</div><!-- .social-icons ends -->
								</div><!-- .author-detail -->							
							</div><!-- .author-desc-box ends -->
						<?php } ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .header-banner ends -->
	<?php 
	} 
	?>
</header>
<!-- #header Section Ends -->