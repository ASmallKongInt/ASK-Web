<?php
# Action Hook "shapeshifter_main_content_singular_page_header"
# Filter Hook "shapeshifter_filters_singular_header"

global $post, $shapeshifter_theme_mods;

echo '<header class="singular-header shapeshifter-singular-header-' . esc_attr( $post->post_type ) . '">';
	// タイトル
	if ( ! SHAPESHIFTER_IS_FRONT_PAGE ) {
		$the_title = the_title( '', '', false );
		echo '<div class="shapeshifter-singular-title-wrapper">';
			echo '<h1 class="p-name entry-title shapeshifter-singular-title shapeshifter-singular-title-' . esc_attr( $post->post_type ) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $shapeshifter_theme_mods[ 'singular_page_h1_animation_hover_select' ] === 'none' )
					? ''
					: ' hover-animated'
				) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $shapeshifter_theme_mods[ 'singular_page_h1_animation_enter_select' ] === 'none' )
					? ''
					: ' shapeshifter-hidden enter-animated'
				) . '" data-animation-hover="' . esc_attr( $shapeshifter_theme_mods[ 'singular_page_h1_animation_hover_select' ] ) . '" data-animation-enter="' . esc_attr( $shapeshifter_theme_mods[ 'singular_page_h1_animation_enter_select' ] ) . '">' . PHP_EOL . ( ! empty( $the_title ) ? $the_title : esc_html__( '( No Title )', 'shapeshifter' ) ) . 
				'</h1>';
		echo '</div>';

	}

	if ( ! SHAPESHIFTER_IS_PAGE 
		&& ! SHAPESHIFTER_IS_ATTACHMENT
	) {
		echo '<div id="singular-page-blogbox" class="blogbox singular-blogbox shapeshifter-singular-blogbox-' . esc_attr( $post->post_type ) . esc_attr(
			( SHAPESHIFTER_IS_MOBILE 
				|| $shapeshifter_theme_mods[ 'singular_page_postinfos_animation_hover_select' ] === 'none' )
			? ''
			: ' hover-animated'
		) . esc_attr(
			( SHAPESHIFTER_IS_MOBILE 
				|| $shapeshifter_theme_mods[ 'singular_page_postinfos_animation_enter_select' ] === 'none' )
			? ''
			: ' shapeshifter-hidden enter-animated'
		) . '" data-animation-hover="' . esc_attr( $shapeshifter_theme_mods[ 'singular_page_postinfos_animation_hover_select' ] ) . '" data-animation-enter="' . esc_attr( $shapeshifter_theme_mods[ 'singular_page_postinfos_animation_enter_select' ] ) . '">';

			$format_ymd = esc_html_x( 'Y/m/d', 'Date Format for Published Date and Updated Date', 'shapeshifter' );
			$mtime_c = ShapeShifter_Frontend_Methods::get_mtime( 'c' );
			$mtime_ymd = ShapeShifter_Frontend_Methods::get_mtime( $format_ymd );
			echo '<p class="content-p">';
				echo '<span class="post-date">';
					echo '<i class="fa fa-calendar"></i>';
					echo '<time class="dt-published entry-date" datetime="' . esc_attr( get_the_time( 'c' ) ) . '">' . esc_html( date_i18n( $format_ymd ) ) . '</time>';
					if ( $mtime_c ) { 
						echo '<time datetime="' . esc_attr( $mtime_c ) . '" class="dt-updated entry-date date updated">'; 
							echo ' <i class="fa fa-repeat"></i>';
							echo esc_html( $mtime_ymd );
						echo '</time>'; 
					} 
					unset( $mtime_c, $mtime_ymd );
				echo '</span>';
			echo '</p>';

			echo '<div class="cats-tags">';
				echo '<p class="p-author h-card post-author vcard author content-p">';
					echo '<i class="fa fa-pencil-square-o"></i>';
					echo '&nbsp;-&nbsp;';
					echo '<a class="content-a" target="_blank" href="' . esc_url( get_author_posts_url( $post->post_author ) ) . '">';
						echo '<span class="fn">' . esc_html( get_the_author() ) . '</span>';
					echo '</a>';
				echo '</p>';

				if ( SHAPESHIFTER_IS_SINGLE ) { if ( ! is_singular( array( 'forum', 'topic', 'replay' ) ) ) {
					if ( get_the_category() ) {
						echo '<p class="content-p">';
							echo '<i class="fa fa-cubes"></i>';
							echo '-';
							echo '<span class="p-category">';
								echo wp_kses( 
									get_the_category_list( 
										', ', '', absint( $post->ID ) 
									), 
									array( 
										'a' => array(
											'href' => array(), 
											'rel' => array()
										) 
									)
								);
							echo '</span>';
						echo '</p>';
					}

					if ( get_the_tags() ) {
						echo '<p class="content-p">';
							echo '<i class="fa fa-tags"></i>';
							echo '&nbsp;-&nbsp;';
							echo '<span class="p-category">';
								echo wp_kses(
									get_the_tag_list( '', ', ', '', absint( $post->ID ) 
									),
									array( 
										'a' => array(
											'href' => array(), 
											'rel' => array()
										) 
									)
								);
							echo '</span>';
						echo '</p>';
					}
				} }
			echo '</div>';

		echo '</div>';
	}

echo '</header>';
