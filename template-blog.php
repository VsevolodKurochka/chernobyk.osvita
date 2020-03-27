<?php
/**
* Template Name: Блог
*/

$context = Timber::get_context();
$post = new TimberPost();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'paged' => $paged
);
$posts_wp = new WP_Query( $args );

$context['post'] = $post;
$context['posts'] = Timber::query_posts( $posts_wp );
$context['sidebar'] = Timber::get_sidebar('sidebar.php');
$context['wp_pagenavi'] = wp_pagenavi(
    [
        'echo' => false,
        'query' => $posts_wp
    ]
);

Timber::render( array( 'template-blog.twig' ), $context );