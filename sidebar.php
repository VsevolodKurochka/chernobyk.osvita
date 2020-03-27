<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = array();
$context['sidebar'] = Timber::get_widgets('sidebar-blog');

Timber::render( array( 'sidebar.twig' ), $context );
