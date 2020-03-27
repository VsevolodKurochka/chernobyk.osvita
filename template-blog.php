<?php
/**
* Template Name: Блог
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['posts'] = new Timber\PostQuery(array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'order' => 'ASC'
));
$context['post'] = $post;
$context['sidebar'] = Timber::get_sidebar('sidebar.php');

Timber::render( array( 'template-blog.twig' ), $context );