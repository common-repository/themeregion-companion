<?php

/**
* Adds TRC: Social widget
*/
class Trcsocial_Widget extends WP_Widget {

	/**
	* Register widget with WordPress
	*/
	function __construct() {

		$widget_ops  = array( 'classname' => 'footer-social trc-social-widget', 'description' => '' );
		parent::__construct(
			'trcsocial_widget', // Base ID
			esc_html__( 'TRC: Social Widget', 'themeregion-companion' ) // Name
		);
	}

	/**
	* Widget Fields
	*/
	private $widget_fields = array(
		array(
			'label' => 'Facebook Url',
			'id' => 'facebookurl_46177',
			'type' => 'text',
		),
		array(
			'label' => 'Twitter Url',
			'id' => 'twitterurl_62951',
			'type' => 'text',
		),
		array(
			'label' => 'Google Plus Url',
			'id' => 'googleplusurl_41444',
			'type' => 'text',
		),
		array(
			'label' => 'Instagram Url',
			'id' => 'instagramurl_37159',
			'type' => 'text',
		),
		array(
			'label' => 'Linkedin Url',
			'id' => 'linkedinurl_18426',
			'type' => 'text',
		),
		array(
			'label' => 'Behance Url',
			'id' => 'behanceurl_78166',
			'type' => 'text',
		),
		array(
			'label' => 'Pinterest Url',
			'id' => 'pinteresturl_21121',
			'type' => 'text',
		),
		array(
			'label' => 'SoundCloud Url',
			'id' => 'soundcloudurl_61141',
			'type' => 'text',
		),
		array(
			'label' => 'Blogger Url',
			'id' => 'bloggerurl_59714',
			'type' => 'text',
		),
		array(
			'label' => 'WordPress Url',
			'id' => 'wordpressurl_63193',
			'type' => 'text',
		),
	);

	/**
	* Front-end display of widget
	*/
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );

		// Output widget title
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses_post( $args['after_title'] );
		}

		echo '<ul class="global-list">';
		// Output generated fields
		if( $instance['facebookurl_46177'] != '' ) :
			echo '<li><a href="'.$instance['facebookurl_46177'].'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['twitterurl_62951'] != '' ) :
			echo '<li><a href="'.$instance['twitterurl_62951'].'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['googleplusurl_41444'] != '' ) :	
			echo '<li><a href="'.$instance['googleplusurl_41444'].'"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['instagramurl_37159'] != '' ) :	
			echo '<li><a href="'.$instance['instagramurl_37159'].'"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['linkedinurl_18426'] != '' ) :	
			echo '<li><a href="'.$instance['linkedinurl_18426'].'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['behanceurl_78166'] != '' ) :	
			echo '<li><a href="'.$instance['behanceurl_78166'].'"><i class="fa fa-behance" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['pinteresturl_21121'] != '' ) :
			echo '<li><a href="'.$instance['pinteresturl_21121'].'"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['soundcloudurl_61141'] != '' ) :
			echo '<li><a href="'.$instance['soundcloudurl_61141'].'"><i class="fa fa-soundcloud" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['bloggerurl_59714'] != '' ) :	
			echo '<li><a href="'.$instance['bloggerurl_59714'].'"><i class="fa fa-rss" aria-hidden="true"></i></a></li>';
		endif;
		if( $instance['wordpressurl_63193'] != '' ) :	
			echo '<li><a href="'.$instance['wordpressurl_63193'].'"><i class="fa fa-wordpress" aria-hidden="true"></i></a></li>';
		endif;
		echo '</ul>';
		
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	* Back-end widget fields
	*/
	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : '';
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'themeregion-companion' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'themeregion-companion' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	/**
	* Sanitize widget form values as they are saved
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
					break;
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
} // class Trcsocial_Widget

// register TRC: Social widget
function register_trcsocial_widget() {
	register_widget( 'Trcsocial_Widget' );
}
add_action( 'widgets_init', 'register_trcsocial_widget' );