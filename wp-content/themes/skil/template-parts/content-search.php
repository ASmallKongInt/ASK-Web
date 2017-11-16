<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package skil
 */

$skil_authorID = get_current_user_id();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-blog-article-style'); ?> itemscope itemtype="http://schema.org/Article">
	<ul class="article-info" itemscope itemtype="http://schema.org/PublicationVolume">
		<li itemscope itemtype="http://schema.org/PublicationIssue">
			<a href="<?php echo esc_url(get_author_posts_url( $skil_authorID )); ?>" class="author">
				<img src="<?php echo esc_url(get_avatar_url( $skil_authorID )); ?>" alt="<?php the_author_meta( 'display_name' , $skil_authorID ); ?>">
				<span>
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
	<h2 itemprop="headline">
		<a href="<?php echo esc_url(get_permalink()); ?>" itemprop="name">
			<?php echo get_the_title(); ?>
		</a>
	</h2>
</article>