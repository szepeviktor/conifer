<?php

use Timber\Timber;
use Conifer\Post\FrontPage;
use Conifer\Post\Post;

$data = $site->get_context();
$data['posts'] = Timber::get_posts();

Timber::render('index.twig', $data);
