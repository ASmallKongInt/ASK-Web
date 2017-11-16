<?php
# Action Hook "shapeshifter_post_list_item"
# Filter Hook "shapeshifter_filters_post_list_item"

global $post, $shapeshifter_theme_mods;

echo '<div id="post-list-item-' . absint( $post->ID ) . '" '; 
	post_class( 'post-list-div' . ( 
		( SHAPESHIFTER_IS_MOBILE 
			|| esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_animation_hover_select' ] ) == 'none' )
		? '' 
		: ' hover-animated'
	) . ( 
		( SHAPESHIFTER_IS_MOBILE 
			|| esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_animation_enter_select' ] ) == 'none' )
		? '' 
		: ' enter-animated shapeshifter-hidden'
	), absint( $post->ID ) ); 
	echo ' data-animation-enter="' . esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_animation_enter_select' ] ) . '"';

	echo ' data-animation-hover="' . esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_animation_hover_select' ] ) . '"';
echo '>';

	echo '<div class="post-list-title-div">';
		echo '<h2 class="post-list-title-div-h2 p-name entry-title' . esc_attr(
				( SHAPESHIFTER_IS_MOBILE 
					|| $shapeshifter_theme_mods[ 'archive_page_post_list_title_box_animation_select' ] == 'none' )
				? '' 
				: ' hover-animated'
			) . '"';
			echo (
				( SHAPESHIFTER_IS_MOBILE || esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_title_box_animation_select' ] ) == 'none' )
				? '' 
				: ' data-animation-hover="' . esc_attr( $shapeshifter_theme_mods[ 'archive_page_post_list_title_box_animation_select' ] ) . '"'
			); 
		echo '>';
			echo '<a class="post-list-title-a"';
				echo ' href="'; the_permalink(); echo '"';
			echo '>';
				$the_title = the_title( '', '', false );
				echo ( ! empty( $the_title ) ? $the_title : esc_html__( '( No Title )', 'shapeshifter' ) );
			echo '</a>';
		echo '</h2>';
	echo '</div>';

	echo '<div class="post-list-bloginfo-div">';
		echo '<div class="bloginfo bloginfo-thumbnail">';
			echo '<a class="post-list-thumbnail-a" href="'; the_permalink(); echo '">';

				$thumbnailURL = esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) );

				$alt = $post_title = wp_strip_all_tags( get_the_title( $post->ID ) );
				if ( $thumbnailURL ) {
					$id = esc_attr( 'post-list-thumbnail' . $post->ID );
					$class = esc_attr( 'post-list-thumbnail' );
					$atts = array(
						'class' => $class,
						'alt' => ( $alt ? $alt : sprintf( esc_html__( 'No Titles - %s', 'shapeshifter' ), SHAPESHIFTER_SITE_NAME ) ),
						'title' => ( 
							$post_title !== ''
							? $post_title 
							: sprintf( 
								esc_html__( 'No Titles - %s', 'shapeshifter' ), 
								esc_html( SHAPESHIFTER_SITE_NAME )
							) 
						),
						'data-style' => 'width: ' . absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_width' ] ) . 'px; height: ' . absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_height' ] ) . 'px; background-size: ' . absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_width' ] ) . 'px ' . absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_height' ] ) . 'px; background-position: center center; background-repeat: no-repeat;'
					);
					echo get_the_post_thumbnail( $post->ID, absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_width' ] ) . 'px ' . absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_height' ] ) . 'px', $atts );
					unset( $atts );

				} else {

					$id = 'post-list-def-thumbnail' . absint( $post->ID );
					$class ='post-list-def-thumbnail';
					$default_cat_thumbnail = ShapeShifter_Frontend_Methods::shapeshifter_get_the_default_thumbnail_url( $post );

					ShapeShifter_Frontend_Methods::shapeshifter_default_thumbnail_img_tag( 
						$class, 
						array( 
							'width' => absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_width' ] ) . 'px', 
							'height' => absint( $shapeshifter_theme_mods[ 'archive_page_post_thumbnail_height' ] ) . 'px' 
						),
						$alt,
						esc_url( $default_cat_thumbnail )
					);
					unset( $default_cat_thumbnail );

				} unset( $thumbnailURL, $alt, $id, $class );

			echo '</a>';
		echo '</div>';

		echo '<div class="bloginfo bloginfo-description">';

			if ( current_user_can( 'edit_others_posts' ) ) { 
				echo '<p class="bloginfo-p bloginfo-p-edit"><i class="fa fa-pencil-square-o"></i><a href="' . esc_url( admin_url( 'post.php?post=' . absint( $post->ID ) . '&action=edit' ) ) . '">' . esc_html__( 'Edit This Page', 'shapeshifter' ) . '</a></p>'; 
			}

			if ( ! SHAPESHIFTER_IS_SEARCH ) {

				echo '<p class="bloginfo-p bloginfo-p-time vcard">';
					echo '<i class="fa fa-user"></i><a class="fn url" href="' . esc_url( get_author_posts_url( $post->post_author ) ) . '">' . esc_html( get_the_author() ) . '</a>';
				echo '</p>';

				echo '<p class="bloginfo-p bloginfo-p-time">';
					echo '<time class="dt-published published updated" datetime="'; the_time( 'c' ); echo '">';
						echo '<i class="fa fa-clock-o"></i>';
						the_time( esc_html_x( 'Y/m/d', 'Date Format', 'shapeshifter' ) );
					echo '&nbsp;</time>';
				echo '</p>';

			}

			if ( get_post_type( $post ) === 'post' ) {

				echo '<p class="bloginfo-p bloginfo-p-categories">';
					echo '<span class="pcone">';
						echo '<i class="fa fa-cubes"></i>';
						the_category( ',' . SHAPESHIFTER_NBSP );
					echo '</span>';
				echo '</p>';

			}

			if ( get_the_terms( absint( $post->ID ), 'post_tag' ) ) {
				echo '<p class="bloginfo-p bloginfo-p-tags">';
					echo '<span>';
						echo '<i class="fa fa-tags"></i>';
						the_tags( '', ',' . SHAPESHIFTER_NBSP );
					echo '</span>';
				echo '</p>';
			}
			
			shapeshifter_archive_read_later( esc_url( get_the_permalink() ), esc_html( get_the_title() ) );

		echo '</div>';

		echo '<div class="bloginfo-excerpt entry-summary">';

			$excerpt = get_the_excerpt();
			$excerpt_length = absint( apply_filters( 'shapeshifter_filter_excerpt_length', 200 ) );
			if ( $excerpt != '' ) {
				echo wp_strip_all_tags( $excerpt );
			} else {
				shapeshifter_the_excerpt( $post->post_content, $excerpt_length );
			}
			unset( $excerpt, $excerpt_length );

			echo '<a class="read-more-for-post-list" href="'; the_permalink(); echo '">'; esc_html_e( 'Read More', 'shapeshifter' );
			echo '</a>';

		echo '</div>';

	echo '</div>';

echo '</div>';
