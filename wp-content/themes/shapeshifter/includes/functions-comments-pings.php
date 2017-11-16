<?php
# Comments
	if ( ! function_exists( 'shapeshifter_comments_list' ) ) { 
		/**
		 * Print Comment List
		 * 
		 * @param object $comment
		 * @param array  $args
		 * @param int    $depth
		**/
		function shapeshifter_comments_list( $comment, $args, $depth ) {

			echo '<li '; comment_class(); echo' id="li-comment-'; comment_ID(); echo '">';
			echo '<div id="comment-'; comment_ID(); echo '" class="comment-body">';
				echo get_avatar( $comment, 40 );
				//echo '<a href="'; comment_link(); echo'">' . esc_html__( 'Anchor', 'shapeshifter' ) . '</a>';
				echo '<cite class="fn">'; comment_author_link(); echo '</cite>';
				if ( $comment->comment_approved == '0' ) {
					echo '<p class="wait">';
						esc_html_e( '* Waiting for being approved *', 'shapeshifter' );
					echo '</p>';
				}
				echo '<div class="comment-meta">';
					echo '<a href="'; comment_link(); echo '">';
						echo get_comment_date();
					echo '</a>';
					echo get_comment_time();
					edit_comment_link( esc_html__( 'Edit', 'shapeshifter' ), '  ', '' ); 
				echo '</div>';
				
				comment_text();
				
				echo '<div class="reply">';
					comment_reply_link( array_merge( 
						$args, 
						array( 
							'depth' => $depth, 
							'max_depth' => $args[ 'max_depth' ] 
						) 
					) ); 
				echo '</div>';
			echo '</div>';

		}
	}

	if ( ! function_exists( 'shapeshifter_comments_pagination' ) ) {
		/**
		 * Print Comment Pagination
		**/
		function shapeshifter_comments_pagination() {
			echo shapeshifter_get_comments_pagination();
		}
	}
	if ( ! function_exists( 'shapeshifter_get_comments_pagination' ) ) {
		/**
		 * Get Comment Pagination HTML
		 * 
		 * @global object $wp_query
		 * 
		 * @return string HTML
		**/
		function shapeshifter_get_comments_pagination() {

            global $wp_query;

            $total = ( $wp_query->max_num_comment_pages ? absint( $wp_query->max_num_comment_pages ) : 0 );

            if ( $total > 1 ) {

                $current = intval( get_query_var( 'cpage' ) ) ? intval( get_query_var( 'cpage' ) ) : 1;

                $args = array(
                    'end_size'        => 3,
                    'mid_size'        => 3,
                    'prev_text'       => esc_html__( '&laquo; Previous', 'shapeshifter' ),
                    'next_text'       => esc_html__( 'Next &raquo;', 'shapeshifter' ),
                );

	            return sprintf( '<div class="pagination"><span>' . esc_html__( 'Comment Page: %1$d of %2$d', 'shapeshifter' ) . '</span>%3$s</div>', $current, $total, get_the_comments_pagination( $args ) );

			}
			
			return '';

		}
	}

# Pings
	if ( ! function_exists( 'shapeshifter_pings_list' ) ) {
		/**
		 * Print Ping List
		 * 
		 * @param object $comment
		 * @param array  $args
		 * @param int    $depth
		**/
		function shapeshifter_pings_list( $comment, $args, $depth ) {

			echo '<li id="li-comment-'; comment_ID(); echo '" '; comment_class(); echo '>';
			echo '<div id="comment-'; comment_ID(); echo '" class="comment-body">';

				echo get_comment_author_link();

				echo '<div class="comment-meta">';
					get_comment_date();
					edit_comment_link( esc_html__( 'Edit', 'shapeshifter' ), '  ', '' );
				echo '</div>';

				comment_text();

			echo '</div>';

		}
	}

