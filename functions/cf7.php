<?php
function cf7_extra_fields_func( $atts ) {
    $html = '';
    $html .= '<input type="hidden" name="page-title" value="'.get_the_title().'">';
    $html .= '<input type="hidden" name="page-url" value="'.get_the_permalink().'">';
    return $html;
}

add_shortcode( 'cf7_extra_fields', 'cf7_extra_fields_func' );