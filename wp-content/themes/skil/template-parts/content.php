<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

$skil_authorID = get_current_user_id();
$skil_articleHref = get_permalink();
$skil_format = get_post_format() ? : 'standard';
$skil_content = get_the_content();
$skil_content = preg_replace('/(<)([img])(\w+)([^>]*>)/','', $skil_content);
$skil_content = apply_filters('the_content', $skil_content);
$skil_content = str_replace(']]>', ']]&gt;', $skil_content);
$skil_featured_image_url = get_the_post_thumbnail_url();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-blog-article-style'); ?> itemscope itemtype="http://schema.org/Article">
	<?php if ( $skil_format == 'image' && $skil_featured_image_url != '' ): ?>
		<div class="featured-image-container" style="background-image: url(<?php echo esc_url($skil_featured_image_url); ?>);">
			<a href="<?php echo esc_url($skil_articleHref); ?>">
				<i class="fa fa-link"></i>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( $skil_format == 'video' && $skil_featured_image_url != '' ): ?>
		<div class="featured-video-container" style="background-image: url(<?php echo esc_url($skil_featured_image_url); ?>);">
			<a href="<?php echo esc_url($skil_articleHref); ?>" class="cover-all"></a>
			<i class="fa fa-play"></i>
		</div>
	<?php endif; ?>
	<?php if ( $skil_format == 'standard' || $skil_format == 'image' || $skil_format == 'aside' || $skil_format == 'video' || $skil_format == 'quote' || $skil_format == 'link' ): ?>
	<ul class="article-info" itemprop="hasPart" itemscope itemtype="http://schema.org/PublicationVolume">
		<li itemprop="hasPart" itemscope itemtype="http://schema.org/PublicationIssue">
			<a href="<?php echo esc_url(get_author_posts_url( $skil_authorID )); ?>" class="author">
				<img src="<?php echo esc_url(get_avatar_url( $skil_authorID )); ?>" alt="<?php the_author_meta( 'display_name' , $skil_authorID ); ?>" itemprop="image">
				<span itemprop="author">
					<?php the_author_meta( 'display_name' , $skil_authorID ); ?>
				</span>
			</a>
		</li>
		<li itemprop="hasPart" itemscope itemtype="http://schema.org/PublicationIssue">
			<a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
				<time datetime="<?php echo the_date( 'c' ); ?>" itemprop="datePublished">
					<?php echo the_time( get_option( 'date_format' ) ); ?>
				</time>
			</a>
		</li>
		<li itemprop="hasPart" itemscope itemtype="http://schema.org/PublicationIssue">
			<?php

				$skil_categories = get_the_category();
				$skil_separator = ' ';
				$skil_output = '';

				if ( ! empty( $skil_categories ) ) :
					foreach( $skil_categories as $category ) {
						$skil_category_id = get_cat_ID( $category->name );
						$skil_output .= '<a href="' . get_category_link( $skil_category_id ) . '" itemprop="category">';
							$skil_output .= esc_html( $category->name ) . $skil_separator;
						$skil_output .= '</a>';
					}
					echo trim( $skil_output, $skil_separator );
				endif;

			?>
		</li>
	</ul>
	<?php endif; ?>
	<?php if ( $skil_format == 'aside' || $skil_format == 'quote' || $skil_format == 'link' ): ?>
	<div class="aside-format-content <?php if ( $skil_format == 'link' ): ?>link-format<?php endif ?>">
		<?php echo get_the_content(); ?>
	</div>
	<h2 itemprop="headline">
		<a href="<?php echo esc_url($skil_articleHref); ?>" itemprop="name">
			<?php if ( get_the_title() != '' ): ?>
				<?php echo get_the_title(); ?>
			<?php else: ?>
				<?php echo esc_html_e( 'Read More' , 'skil' ); ?>
			<?php endif ?>
		</a>
	</h2>
	<?php endif; ?>
	<?php if ( $skil_format == 'standard' || $skil_format == 'image' || $skil_format == 'video' ): ?>
	<h2 itemprop="headline">
		<a href="<?php echo esc_url($skil_articleHref); ?>" itemprop="name">
			<?php if ( get_the_title() != '' ): ?>
				<?php echo get_the_title(); ?>
			<?php else: ?>
				<?php echo esc_html_e( 'Read More' , 'skil' ); ?>
			<?php endif ?>
		</a>
	</h2>
	<?php endif; ?>
</article>