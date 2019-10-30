<?php
/**
* Template Name: Среднее образование - Чехия
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-landing-czech.twig' ), $context );