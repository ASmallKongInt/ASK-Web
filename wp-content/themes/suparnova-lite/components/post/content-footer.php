	<footer class="entry-footer">
		<div class="left counts">
			<a href="<?php echo esc_url( get_comments_link() ); ?>"><i class="fa fa-comments-o"></i> <?php echo esc_html( get_comments_number() ); ?></a>
		</div>
		<?php if( !is_single() ) : ?>
		<div class="right readmore">
			<h6><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'suparnova-lite' ); ?></a></h6>
		</div>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
	
<?php

if( is_single() ) {
	$fname = get_the_author_meta( 'first_name' );
	$lname = get_the_author_meta( 'last_name' );
	$full_name = trim( "{$fname} {$lname}" );
	$user_socials = get_the_author_meta( 'ts-user-social-media' );
	$medias = suparnova_lite_social_media_array();
	?>
	<div class="suparnova-lite-author-box">
		<div class="author-box-inner">
			<div class="author-image">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 180 ); ?>
			</div>
			<div class="author-details">
				<h4 class="author-name"><a href="<?php the_author_meta('url'); ?>"><?php echo esc_html( $full_name ); ?></a></h4>
				<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
			</div>
		</div>
	</div>
	<?php
}