<?php
    add_filter('use_block_editor_for_post', '__return_false', 10);
    //add_filter('show_admin_bar', '__return_false');

    add_filter( 'wpseo_sitemap_exclude_post_type', 'sitemap_exclude_post_type', 10, 2 );
    function sitemap_exclude_post_type( $value, $post_type ) {
        $post_type_to_exclude = array('reviews');
        if( in_array( $post_type, $post_type_to_exclude ) ) return true;
    }
