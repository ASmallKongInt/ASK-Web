<?php
#-----------------------------------------------------------------#
#------------------- CULTURE : CUSTOM STYLES  --------------------#
#-----------------------------------------------------------------#

//Get required theme custom values
$header_image     = get_header_image();
$header_image     = !empty($header_image) ? $header_image : get_template_directory_uri().'/images/dp-placeholder.png';
$header_sticky    = get_theme_mod('header_sticky');
$mob_menu_active  = get_theme_mod('mob_menu_active');
$header_sticky    = (!empty($header_sticky)) ? $header_sticky : 'on';
$mob_menu_active  = (!empty($mob_menu_active)) ? esc_attr($mob_menu_active) : '1024';
?>
<!-- Culture Customizer Options// -->
<style type="text/css">
<?php if(!empty($header_image)){ ?>
	#header .header-banner, #header .global-banner{background-image:url('<?php echo esc_url( $header_image ); ?>')}
<?php } ?>
</style>
<!-- \\Culture Customizer Options -->