<?php
/**
* Template Name: Среднее образование - Словакия
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-landing-slovakia.twig' ), $context );