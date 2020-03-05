<?php
/**
* Template Name: Среднее образование
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-education-europe.twig' ), $context );