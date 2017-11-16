<?php

/**
 * Custom Categories
 */
class Suparnova_Lite_Categories extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'suparnova_lite_categories',
			'description' => __( 'Same as default categories widget, but designed differently.', 'suparnova-lite' ),
		);
		parent::__construct( 'suparnova_lite_categories', __( 'Suparnova - Categories', 'suparnova-lite' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$only_parents = ! empty( $instance['only_parents'] ) ? $instance['only_parents'] : '';
		$hide_empty = ! empty( $instance['hide_empty'] ) ? $instance['hide_empty'] : '';
		$min_posts = ! empty( $instance['min_posts'] ) ? $instance['min_posts'] : 0;
		
		$cat_args = array();
		
		if( !empty( $only_parents ) ) {
			$cat_args['parent'] = 0;
		}
		if( !empty( $hide_empty ) ) {
			$cat_args['hide_empty'] = true;
		}
		
		echo wp_kses_post( $args['before_widget'] );
		
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'] );
		}
		
		$categories = get_categories( $cat_args );
		
		if( !empty( $categories ) ) {
			echo '<ul>';
			foreach ( $categories as $category ) {
				if( $category->count < $min_posts ) {
					continue;
				}
				printf( '<li><a href="%s">%s<span class="count">%s</span></a>', esc_url( get_term_link( $category ) ), esc_html( $category->name ), esc_html( $category->count ) );
			}
			echo '</ul>';
		}
		
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$min_posts = ! empty( $instance['min_posts'] ) ? $instance['min_posts'] : 0;
		$only_parents = ! empty( $instance['only_parents'] ) ? $instance['only_parents'] : '';
		$hide_empty = ! empty( $instance['hide_empty'] ) ? $instance['hide_empty'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'suparnova-lite' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'min_posts' ) ); ?>"><?php esc_attr_e( 'Hide categories under # of posts:', 'suparnova-lite' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'min_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'min_posts' ) ); ?>" type="number" value="<?php echo esc_attr( $min_posts ); ?>">
		</p>
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'only_parents' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'only_parents' ) ); ?>" type="checkbox" value="1" <?php checked( $only_parents, '1' ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'only_parents' ) ); ?>"><?php esc_attr_e( 'Show only top level categories', 'suparnova-lite' ); ?></label> 
		</p>
		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>" type="checkbox" value="1" <?php checked( $hide_empty, '1' ); ?>>
		<label for="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>"><?php esc_attr_e( 'Hide empty categories', 'suparnova-lite' ); ?></label> 
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['min_posts'] = ( ! empty( $new_instance['min_posts'] ) ) ? absint( $new_instance['min_posts'] ) : 0;
		$instance['only_parents'] = ( ! empty( $new_instance['only_parents'] ) ) ? absint( $new_instance['only_parents'] ) : '';
		$instance['hide_empty'] = ( ! empty( $new_instance['hide_empty'] ) ) ? absint( $new_instance['hide_empty'] ) : '';

		return $instance;
	}
}