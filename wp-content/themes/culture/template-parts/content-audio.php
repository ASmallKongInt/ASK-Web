<?php
/**
 * Template part for displaying audio posts
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
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;

		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}

	?>

	<?php
		culture_post_thumbnail(); // post thumbnail
	?>

	<div class="entry-content">

		<?php if ( ! is_single() ) :

			// If not a single post, highlight the audio file.
			if ( ! empty( $audio ) ) :
				foreach ( $audio as $audio_html ) {
					echo '<div class="entry-audio">';
						echo $audio_html;
					echo '</div><!-- .entry-audio -->';
				}
			endif;

		endif;

		if ( is_single() || empty( $audio ) ) :

			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'culture' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'culture' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		endif; 
		
		culture_entry_footer(); // post footer entry
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->