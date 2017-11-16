<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Suparnova
 */

$suparnova_lite_disable_schema = suparnova_lite_global_get( 'suparnova_lite_disable_schema_markup', false );

if( is_single() ) {
	$item_type = 'http://schema.org/Article';
} else {
	$item_type = 'http://schema.org/BlogPosting';
}
if( $suparnova_lite_disable_schema !== true ) {
?>
<article itemscope itemtype="<?php echo esc_url( $item_type ); ?>" id="post-<?php the_ID(); ?>" <?php post_class('suparnova-lite-basic-post'); ?>>
	
	<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>">
<?php } else { ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('suparnova-lite-basic-post'); ?>>
<?php } ?>
	
	<?php if( has_post_thumbnail() ) : ?>
	
	<div class="entry-thumbnail">
		<?php
		get_template_part( 'components/post/content', 'category' );
		the_post_thumbnail('full');
		$img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if( $suparnova_lite_disable_schema !== true ) {
		?>
		<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo esc_url( $img_src[0] ); ?>">
			<meta itemprop="width" content="<?php echo esc_attr( $img_src[1] ); ?>">
			<meta itemprop="height" content="<?php echo esc_attr( $img_src[2] ); ?>">
		</span>
		<?php } ?>
	</div>
	
	<?php else:
		get_template_part( 'components/post/content', 'category' );
	endif; ?>
	
	<h3 class="entry-title"><?php
	if( $suparnova_lite_disable_schema !== true ) {
		the_title( '<a itemprop="url" href="' . esc_url( get_permalink() ) . '"><span itemprop="name headline">', '</span></a>' );
	} else {
		the_title( '<a href="' . esc_url( get_permalink() ) . '">', '</a>' );
	}
	?></h3>
	
	<?php get_template_part( 'components/post/content', 'meta' ); ?>
	
	<div<?php if( $suparnova_lite_disable_schema !== true ) { ?> itemprop="articleBody"<?php } ?> class="entry-content">
		<?php if( is_single() ) :
			
			the_content();

			wp_link_pages( array(
				'before' => '<nav class="post-pagination"><div class="page-links"><span class="page-link nav-label">' . esc_html__( 'Pages:', 'suparnova-lite' ) . '</span>',
				'after'  => '</div></nav>',
				'link_before' => '<span class="page-link">',
				'link_after' => '</span>',
			) );
			
			?><p class="tagged-by"><?php the_tags( '', ' / ' ); ?></p><?php
			
		elseif( post_password_required() ) :
			the_content();
		else : ?>
		<p class="block-post-content"><?php echo wp_kses_post( wp_trim_words( strip_shortcodes( get_the_content() ), 45, '...' ) ); ?></p>
		<?php endif; ?>
	</div>
	
	<?php get_template_part( 'components/post/content', 'footer' ); ?>
	
</article><!-- #post-## -->