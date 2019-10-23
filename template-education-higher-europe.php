<?php
/**
* Template Name: Высшее образование Европа
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-education-higher-europe.twig' ), $context );