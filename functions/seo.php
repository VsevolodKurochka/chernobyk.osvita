<?php

add_action( 'template_redirect', 'custom_template_redirect', 0 );
function custom_template_redirect()
{
    if( is_page() )
    {
        global $post, $page;
        $num_pages = substr_count( $post->post_content, '<!--nextpage-->' ) + 1;
        if( $page > $num_pages ){
            global $wp_query;
            $wp_query->set_404();
            status_header( 404 );
            get_template_part( 404 ); exit();
        }
    }
}

add_action('parse_request', 'parseUppercase');
function isPartUppercase($string) {
    return (bool) preg_match('/[A-Z]/', $string);
}
function parseUppercase($wp) {
    $query = $wp->query_vars;
    if( $query && isset($query['pagename']) && isPartUppercase($query['pagename']) ) {
        $link = site_url(). '/' . strtolower($query['pagename']);
        wp_redirect( $link , 301 );
        exit();
    }
}


function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];

        if ( $script->deps ) { // Check whether the script has any dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}

add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
