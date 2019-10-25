<?php
/**
* Template Name: Услуги
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( array( 'template-services.twig' ), $context );