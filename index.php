<?php 

$context = Timber::context();
$context['msg'] = 'Hi from back';
$context['post'] = new Timber\Post();


Timber::render('index.twig', $context);