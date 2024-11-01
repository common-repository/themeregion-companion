<?php 

if ( !function_exists( 'trc_get_post_views' ) ) {
    function trc_get_post_views( $postID ){
        $count_key = 'trc_post_views_count';
        $count = get_post_meta( $postID, $count_key, true );
        $views_string = ( $count == 0 || $count > 1 ) ? esc_html__( 'Views', 'themeregion-companion' ) : esc_html__( 'View', 'themeregion-companion' );
        if( $count == '' ){
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, '0' );
            $return_data = sprintf(
                esc_html( '0 %s' ),
                $views_string
            );
            return $return_data;
        }
        $return_data = sprintf(
            esc_html( '%s %s' ),
            $count, $views_string
        );
        return $return_data;
    }
}

if ( !function_exists( 'trc_set_post_views' ) ) {
    function trc_set_post_views( $postID ) {
        $count_key = 'trc_post_views_count';
        $count = get_post_meta( $postID, $count_key, true );
        if( $count == '' ) {
            $count = 0;
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, '0' );
        }else {
            $count++;
            update_post_meta( $postID, $count_key, $count );
        }
    }
}