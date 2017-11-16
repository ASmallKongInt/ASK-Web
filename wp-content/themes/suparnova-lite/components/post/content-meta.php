<?php
$suparnova_lite_disable_schema = suparnova_lite_global_get( 'suparnova_lite_disable_schema_markup', false );
/* translators: %s: human-readable time difference */
$hrt_string = sprintf( esc_html_x( '%s ago', '%s = human-readable time difference', 'suparnova-lite' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
if( suparnova_lite_theme_option( 'enable_hrt_date' ) != true ) {
	$hrt_string = get_the_date();
}
?>
	<div class="entry-meta">
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a>
		<a href="<?php the_permalink(); ?>"><i class="fa fa-calendar"></i> <?php echo esc_html( $hrt_string ); ?></a>
		
	</div>
	<?php if( $suparnova_lite_disable_schema !== true ) { ?>
	<meta itemprop="datePublished" content="<?php echo esc_html( get_the_date( 'c' ) ); ?>">
	<meta itemprop="dateModified" content="<?php echo esc_html( get_the_modified_date( 'c' ) ); ?>">
	<meta itemprop="author" content="<?php the_author(); ?>">
	<div itemtype="https://schema.org/Organization" itemscope="itemscope" itemprop="publisher">
		<link itemprop="url" href="<?php echo esc_url( home_url('/') ); ?>"> 
		<meta itemprop="name" content="<?php bloginfo('name'); ?>">
		<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="https://www.usa-reisetipps.net/images/usa-amp-logo.png">
			<meta itemprop="width" content="600">
			<meta itemprop="height" content="60">
		</span>
	</div>
	<?php } ?>