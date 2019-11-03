<?php
/**
* Template Name: Контакты
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-contacts.twig' ), $context );