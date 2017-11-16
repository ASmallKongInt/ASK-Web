<?php
# Action Hook "shapeshifter_wc_header"
# Filter Hook "shapeshifter_filters_wc_header"

echo '<header class="singular-header shapeshifter-singular-header-' . esc_attr( $post->post_type ) . '">';
	// タイトル
	echo '<div class="shapeshifter-singular-title-wrapper">';
		echo ( 
			SHAPESHIFTER_IS_FRONT_PAGE 
			? '<h2 class="p-name entry-title shapeshifter-singular-title shapeshifter-singular-title-' . esc_attr( $post->post_type ) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $this->theme_mods[ 'singular_page_h1_animation_hover_select' ] === 'none' )
					? ''
					: ' hover-animated'
				) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $this->theme_mods[ 'singular_page_h1_animation_enter_select' ] === 'none' )
					? ''
					: ' shapeshifter-hidden enter-animated'
				) . '"' .
				' data-animation-hover="' . esc_attr( $this->theme_mods[ 'singular_page_h1_animation_hover_select' ] ) . '"' . 
				' data-animation-enter="' . esc_attr( $this->theme_mods[ 'singular_page_h1_animation_enter_select' ] ) . '">' 
			: '<h1 class="p-name entry-title shapeshifter-singular-title shapeshifter-singular-title-' . esc_attr( $post->post_type ) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $this->theme_mods[ 'singular_page_h1_animation_hover_select' ] === 'none' )
					? ''
					: ' hover-animated'
				) . esc_attr( 
					( SHAPESHIFTER_IS_MOBILE 
						|| $this->theme_mods[ 'singular_page_h1_animation_enter_select' ] == 'none' )
					? ''
					: ' shapeshifter-hidden enter-animated'
				) . '"' .
				' data-animation-hover="' . esc_attr( $this->theme_mods[ 'singular_page_h1_animation_hover_select' ] ) . '"' .
				' data-animation-enter="' . esc_attr( $this->theme_mods[ 'singular_page_h1_animation_enter_select' ] ) . '">' 
		) . esc_html( $post->post_title ) . ( 
			SHAPESHIFTER_IS_FRONT_PAGE 
			? '</h2>' 
			: '</h1>' 
		);
	echo '</div>';
echo '</header>';

