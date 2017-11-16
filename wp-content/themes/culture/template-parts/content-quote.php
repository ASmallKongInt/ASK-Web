<?php
/**
 * Template part for displaying Quote posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Culture
 * @since 1.0
 * @version 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-content-box post'); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			_e("<h3 class='sticky-post'>featured</h3>",'culture');
		endif;
	?>
	
	<header class="entry-header clearfix">	
		<?php if ( 'post' === get_post_type()){ ?>
			<div class="col-md-9 col-sm-12 col-xs-12 ttl-cat-wrap <?php if ( get_post_type() != 'post' ) { ?> border-none <?php } ?>">
				<h1 class="entry-title">					
					<?php if(is_single()){ ?>
						<?php the_title(); ?>
					<?php } else { ?>
						<a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<?php } ?>
				</h1>
				<?php if(has_category()){ ?><span class="category"><?php the_category('&nbsp;,'); ?></span><?php } ?>
			</div>
		<?php
		} 
		?>
		
		<?php if ( 'post' === get_post_type() ){ ?>
			<div class="col-md-3 col-sm-12 col-xs-12 date-auth-wrap">
				<h5 class="date"><?php the_time( get_option( 'date_format' ) ); ?></h5>
				<h4 class="author-name"><?php the_author_posts_link(); ?> </h4>					
			</div>
		<?php 
		} 
		?>
	</header><!-- .entry-header -->
	
	<?php
		culture_post_thumbnail(); // post thumbnail
	?>

	<div class="entry-content">
		<?php
			/* Post Tags */		
			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'culture' ) );
			if ( $tags_list ) {
				printf( '<div class="post-tags"><i class="fa fa-tag" aria-hidden="true"></i><span class="screen-reader-text">%1$s </span>%2$s</div>',
					_x( 'Tags', 'Used before tag names.', 'culture' ),
					$tags_list
				);
			}
		
			/* translators: %s: Name of current post */
			?>
			<div class="post-quote">
				<?php
				if(is_single()){ 
				the_content( sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'culture' ),
					get_the_title()
				) );
				} else {
					the_excerpt( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'culture' ),
						get_the_title()
					) );
				} 

				?>
			</div>
			<?php

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'culture' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

			culture_entry_footer(); // post footer entry
		?>
	</div><!-- .entry-content -->
</article><!-- #post-->