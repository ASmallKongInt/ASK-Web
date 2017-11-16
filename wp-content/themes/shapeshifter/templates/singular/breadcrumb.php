<?php
# Action Hook "shapeshifter_breadcrumb"
# Filter Hook "shapeshifter_filters_breadcrumb"

if (
	! ( SHAPESHIFTER_IS_HOME 
		|| SHAPESHIFTER_IS_FRONT_PAGE
	)
) {

	echo '<div id="breadcrumb" class="breadcrumb"><div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';

		echo '<a href="' . esc_url( SHAPESHIFTER_SITE_URL ) . '" itemprop="url"><i class="fa fa-home"></i> <span itemprop="title">' . esc_html__( 'Home', 'shapeshifter' ) . '</span></a> / </div>';

		if ( is_category() ) {

			$cat = get_queried_object();

			if ( $cat->parent != 0 ) {

				$ancestors = array_reverse( get_ancestors( absint( $cat->cat_ID ), 'category' ) );

				if ( is_array( $ancestors ) && 0 < count( $ancestors ) ) { foreach( $ancestors as $ancestor ) {

					echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( get_category_link( $ancestor ) ) . '" itemprop="url"><i class="fa fa-archive"></i> <span itemprop="title">' . esc_html( get_cat_name( $ancestor ) ) . '</span></a> /</div>';

				} } unset( $ancestors );
			}

			echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . esc_html( SHAPESHIFTER_NBSP ) . '<a href="' . esc_url( get_category_link( absint( $cat->term_id ) ) ) . '" itemprop="url"><i class="fa fa-archive"></i>' . esc_html( SHAPESHIFTER_NBSP ) . '<span itemprop="title">' . esc_html( $cat->cat_name ) . '</span></a></div>';
			unset( $cat );

		} elseif ( SHAPESHIFTER_IS_PAGE ) {

			if ( $post->post_parent != 0 ){

				$ancestors = array_reverse( get_post_ancestors( absint( $post->ID ) ) );

				if ( is_array( $ancestors ) && 0 < count( $ancestors ) ) { foreach( $ancestors as $ancestor ) {

					echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . esc_html( SHAPESHIFTER_NBSP ) . '<a href="' . esc_url( get_permalink( $ancestor ) ) .'" itemprop="url"><i class="fa fa-archive"></i>' . esc_html( SHAPESHIFTER_NBSP ) . '<span itemprop="title">' . esc_html( get_the_title( $ancestor ) ) . '</span></a></div>';

				} } $ancestors = null;

			}

		} elseif ( SHAPESHIFTER_IS_SINGLE ) {

			$categories = get_the_category( absint( $post->ID ) );
			if( isset( $categories[ 0 ] ) ) {

				$cat = $categories[ 0 ];

				if ( $cat->parent != 0 ) {

					$ancestors = array_reverse( get_ancestors( absint( $cat->cat_ID ), 'category' ) );

					if ( is_array( $ancestors ) && 0 < count( $ancestors ) ) { foreach( $ancestors as $ancestor ) {

						echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . esc_html( SHAPESHIFTER_NBSP ) . '<a href="' . esc_url( get_category_link( $ancestor ) ) . '" itemprop="url"><i class="fa fa-archive"></i>' . esc_html( SHAPESHIFTER_NBSP ) . '<span itemprop="title">' . esc_html( get_cat_name( $ancestor ) ) . '</span></a> /</div>';
						unset( $ancestor );

					} }
					unset( $ancestors );

				}

				echo '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">' . esc_html( SHAPESHIFTER_NBSP ) . '<a href="' . esc_url( get_category_link( absint( $cat->term_id ) ) ) . '" itemprop="url"><i class="fa fa-archive"></i>' . esc_html( SHAPESHIFTER_NBSP ) . '<span itemprop="title">' . esc_html( $cat->cat_name ) . '</span></a> /</div>';
				unset( $cat );

			}
			unset( $categories );

		}

	echo '</div>';

}
