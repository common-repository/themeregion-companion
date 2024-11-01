<?php

class TRC_Recent_Posts_Widget extends WP_Widget {

    function __construct() {
        $widget_ops  = array( 'classname' => 'widget_recent_entries trc_recent_entries', 'description' => '' );
        $control_ops = array( 'id_base' => 'trc_recent_posts_widget' );
        parent::__construct( 'trc_recent_posts_widget', 'TRC: Recent Posts', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ){

        extract($args);
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'themeregion-companion' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $post_type = $instance['post_type'];
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : -1;
        if ( ! $number )
            $number = -1;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        $show_date_in_place = $instance['show_date_in_place'];

        $args = array(
            'post_type'              => array( $post_type ),
            'post_status'            => array( 'publish' ),
            'ignore_sticky_posts'    => true,
            'posts_per_page'         => $number,
        );
        $r = new WP_Query( $args );
        if( $r->have_posts() ) :
            echo wp_kses_post( $before_widget );
            ?>
            <?php if ( $title ) : printf("%s %s %s",$before_title, $title, $after_title); endif;?>
            <ul class="tr-list">
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li> 
                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="entry-thumbnail">
                            <?php $url_thumbpost = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array('220','125'), true ); ?>
                            <?php $buffer = '<a href="'.get_the_permalink($r->the_ID()).'"><img width="'. esc_attr( $url_thumbpost[1] ) .'" height="'. esc_attr( $url_thumbpost[2] ) .'" class="img-fluid" src="'. esc_url( $url_thumbpost[0] ) .'" alt="'. get_the_title() .'"></a>'; ?>
                            <?php echo wp_kses_post( $buffer ); ?>
                        </div>
                    <?php endif; ?>
                        <div class="entry-content">
                            <?php if ( $show_date && $show_date_in_place == 'before_title' ) : ?>
                                <span class="tr-widget-post-date"><?php echo get_the_date(); ?></span>
                            <?php endif; ?>
                            <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
                            <?php if ( $show_date && $show_date_in_place == 'after_title' ) : ?>
                                <span class="tr-widget-post-date"><?php echo get_the_date(); ?></span>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            
            <?php
            echo wp_kses_post( $after_widget );
            wp_reset_postdata();
        endif;
    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_type'] = $new_instance['post_type'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = (bool) $new_instance['show_date'];
        $instance['show_date_in_place'] = $new_instance['show_date_in_place'];

        return $instance;
    }

    function form( $instance ) {

        $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $post_type          = isset( $instance['post_type'] ) ? esc_attr( $instance['post_type'] ) : '';
        $number             = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date          = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        $show_date_in_place = isset( $instance['show_date_in_place'] ) ?  esc_attr( $instance['show_date_in_place'] ) : '';
        ?>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'themeregion-companion' ); ?></label>
        <input class="widefat" id="<<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $title ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php _e( 'Post Type:', 'themeregion-companion' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>">
            <option value="post" <?php echo ($post_type == 'post') ? 'selected' : '' ?>><?php esc_html_e( 'Post', 'themeregion-companion' ); ?></option>
            <option value="folio" <?php echo ($post_type == 'folio') ? 'selected' : '' ?>><?php esc_html_e( 'Portfolio', 'themeregion-companion' ); ?></option>
        </select>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'themeregion-companion' ); ?></label>
        <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_html( $number ); ?>" size="3" /></p>
        
        <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
        <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?', 'themeregion-companion' ); ?></label></p>  

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'show_date_in_place' ) ); ?>"><?php _e( 'Show Date Before/After Title:', 'themeregion-companion' ); ?></label>
        <select name="<?php echo esc_attr( $this->get_field_name( 'show_date_in_place' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show_date_in_place' ) ); ?>">
            <option value="before_title" <?php echo ($show_date_in_place == 'before_title') ? 'selected' : '' ?>><?php esc_html_e( 'Before Title', 'themeregion-companion' ); ?></option>
            <option value="after_title" <?php echo ($show_date_in_place == 'after_title') ? 'selected' : '' ?>><?php esc_html_e( 'After Title', 'themeregion-companion' ); ?></option>
        </select>        
    <?php
    }
}


function trc_recent_posts() {

    register_widget('trc_recent_posts_widget');
}
add_action('widgets_init', 'trc_recent_posts');