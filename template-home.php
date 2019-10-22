<?php
/**
* Template Name: Главная
*/

$context = Timber::get_context();
$post = new TimberPost();

$reviews_args = array(
    'post_type' => 'reviews',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'order' => 'ASC'
);

$context['reviews'] = new Timber\PostQuery($reviews_args);
$context['post'] = $post;

Timber::render( array( 'template-home.twig' ), $context );