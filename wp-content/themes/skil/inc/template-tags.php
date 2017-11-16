<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package skil
 */

if ( ! function_exists( 'skil_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function skil_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'skil' ) );
			if ( $categories_list && skil_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'skil' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'skil' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'skil' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'skil' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'skil' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;

if( !function_exists('skil_comment') ) :

	// Comments Template

	function skil_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$skil_add_below = 'comment';
		} else {
			$tag = 'li';
			$skil_add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="left-section">
			<?php if ( $args['avatar_size'] != 0 ) echo esc_url(get_avatar( $comment, 40 )); ?>
		</div>
		<div class="right-section">
			<div class="comment-author-link">
				<a>
					<?php printf( esc_html__( '%s' , 'skil' ), get_comment_author_link() ); ?>
				</a>
			</div>
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $skil_add_below , 'reply_text' => esc_html__('Reply ', 'skil'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			<p class="time-comment">
				<?php
				/* translators: 1: date, 2: time */
				printf( esc_html__( '%1$s' , 'skil' ), get_comment_date()); ?></a><?php edit_comment_link( esc_html__( ' - (Edit)' , 'skil' ), '  ', '' );
				?>
			</p>
			<div class="comment-text">
				<?php comment_text(); ?>
			</div>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'skil' ); ?></em>
			<br />
		<?php endif; ?>
		<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif; ?>
	<?php }

endif;