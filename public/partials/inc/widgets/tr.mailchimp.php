<?php

add_action( 'widgets_init', function(){
    register_widget( 'TRC_Mailchimp' );
});

class TRC_Mailchimp extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $widget_ops = array(
            'classname'   => 'left-content trc-mailchimp',
            'description' => 'Enter your mailchimp form shortcode here.',
        );

        parent::__construct( 'trc_mailchimp', 'TRC: Mailchimp', $widget_ops );
    }


    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        // outputs the content of the widget
        echo wp_kses_post( $args['before_widget'] );
        extract( $instance );
         echo '<div class="footer-widget">';
        if ( ! empty( $instance['title'] ) ) {
            printf( '%s', $args['before_title'] );
            echo apply_filters( 'widget_title', $instance['title'] );
            printf( '%s', $args['after_title'] );
        }
        echo '<p>';
        if ( !empty( $description ) ) {
            printf( '%s', $description );
        }
        echo '</p>';
        if ( !empty( $mailchimp_sc ) ) {
            echo do_shortcode($mailchimp_sc);
        }
        echo '</div>';
        echo wp_kses_post( $args['after_widget'] );
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {

        // outputs the options form on admin
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Sign up for newsletter', 'themeregion-companion' );        
        $description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'Enter your email to receive relevant messaging tips and examples.', 'themeregion-companion' );
        $mailchimp_sc = ! empty( $instance['mailchimp_sc'] ) ? $instance['mailchimp_sc'] : '';
        ?>
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'themeregion-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Description:', 'themeregion-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
            </p>
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'mailchimp_sc' ) ); ?>"><?php _e( 'Enter Shortcode', 'themeregion-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mailchimp_sc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mailchimp_sc' ) ); ?>" type="text" value="<?php echo esc_attr( $mailchimp_sc ); ?>">
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
        foreach( $new_instance as $key => $value ) {
            $updated_instance[$key] = sanitize_text_field( $value );
        }

        return $updated_instance;
    }
}