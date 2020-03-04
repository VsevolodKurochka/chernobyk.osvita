<?php
/**
* Template Name: Среднее образование - Польша
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-landing-poland.twig' ), $context );