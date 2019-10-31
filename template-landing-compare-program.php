<?php
/**
* Template Name: Среднее образование - Сравнительная программа
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-landing-compare-program.twig' ), $context );